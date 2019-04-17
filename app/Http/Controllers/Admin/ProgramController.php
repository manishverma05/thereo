<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Session;
use App\Models\Resource;
use App\User;
use App\Models\Role;
use App\Models\ProgramCategory;
use App\Models\ProgramCategoryMap;
use App\Models\ProgramAuthorMap;
use App\Models\ProgramSessionMap;
use App\Models\ProgramResourceMap;
use App\Models\ProgramCoverMedia;
use App\Models\ProgramAccessMap;
use App\Http\Requests\AdminProgramCreateRequest;
use App\Http\Requests\AdminProgramUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;

class ProgramController extends Controller {

    public function getList() {
        $programs = Program::with('cover_media')->orderBy('id', 'desc')->get();
        $sessions = Session::with('cover_media')->orderBy('id', 'desc')->get();
        $resources = Resource::with('cover_media')->orderBy('id', 'desc')->get();
        $program_categories = ProgramCategory::orderBy('id', 'desc')->get();
        return view('admin.program.index')
                        ->withPagetitle('Programs')
                        ->withPageheader('Programs')
                        ->withPrograms($programs)
                        ->withSessions($sessions)
                        ->withResources($resources)
                        ->withProgramCategories($program_categories);
    }

    public function getCreate() {
        $sessions = Session::orderBy('id', 'desc')->get();
        $roles = Role::orderBy('id', 'desc')->get();
        $resources = Resource::orderBy('id', 'desc')->get();
        $authors = User::where('role_id', 3)->orderBy('id', 'desc')->get();
        $program_categories = ProgramCategory::orderBy('id', 'desc')->get();
        return view('admin.program.create')
                        ->withPagetitle('New Program')
                        ->withPageheader('New Program')
                        ->withSessions($sessions)
                        ->withRoles($roles)
                        ->withResources($resources)
                        ->withAuthors($authors)
                        ->withProgramCategories($program_categories);
    }

    public function postCreate(AdminProgramCreateRequest $request) {
        // Retrieve the validated input data...
        $validation = $request->validated();

        // create new program and save it
        $program = new Program;
        $program->unique_id = uniqid() . uniqid();
        $program->slug = $request->slug ? $request->slug : Str::slug($request->title, '-');
        $program->title = $request->title;
        $program->title_alt = $request->title_alt;
        $program->description = $request->description;
        $program->cover_title = $request->cover_title;
        $program->tags = $_REQUEST['hidden-tags'];
        $program->created_by = auth()->user()->id;
        $program->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $program->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $program->save();

        #save access for session
        if (isset($request->role_id)) {
            foreach ($request->role_id as $role_id) {
                $session_role = new ProgramAccessMap;
                $session_role->role_id = $role_id;
                $session_role->program_id = $program->id;
                $session_role->save();
            }
        }

        #save sessions for program
        if (isset($request->session_id)) {
            foreach ($request->session_id as $session_id) {
                $program_session = new ProgramSessionMap;
                $program_session->session_id = $session_id;
                $program_session->program_id = $program->id;
                $program_session->save();
            }
        }
        #save authors for program
        if (isset($request->author_id)) {
            foreach ($request->author_id as $author_id) {
                $program_author = new ProgramAuthorMap;
                $program_author->user_id = $author_id;
                $program_author->program_id = $program->id;
                $program_author->save();
            }
        }
        #save program_categories for program
        if (isset($request->program_category_id)) {
            foreach ($request->program_category_id as $program_category_id) {
                $program_category_map = new ProgramCategoryMap;
                $program_category_map->program_category_id = $program_category_id;
                $program_category_map->program_id = $program->id;
                $program_category_map->save();
            }
        }
        #save resources for program
        if (isset($request->resource_id)) {
            foreach ($request->resource_id as $resource_id) {
                $program_resource = new ProgramResourceMap;
                $program_resource->resource_id = $resource_id;
                $program_resource->program_id = $program->id;
                $program_resource->save();
            }
        }

        if (isset($request->cover_image)) {
            $imageName = strtolower($request->cover_image->getClientOriginalName());
            $destination = config('constants.program.cover_path');
            $i = 1;
            while (true) {
                if (!file_exists($destination . $imageName)) {
                    break;
                }
                $imageName = ++$i . $imageName;
            }
            $img = Image::make($request->cover_image->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save(config('constants.program.cover_path') . 'thumb_' . $imageName);

            $request->cover_image->move($destination, $imageName);
            $program_cover_media = new ProgramCoverMedia;
            $program_cover_media->unique_id = uniqid() . uniqid();
            $program_cover_media->program_id = $program->id;

            $program_cover_media->file = $imageName;
            $program_cover_media->created_by = auth()->user()->id;
            $program_cover_media->save();
        }

        return redirect()->route('admin.program.list')->with('success', 'Program has been added.');
//        https://laravel.io/forum/06-11-2014-how-to-save-eloquent-model-with-relations-in-one-go
//        $ship = new Ship;
//        $ship->name = 'Enterprise';
//        $ship->registry = 'ncc-1701D';
//
//        $captain = new Captain;
//        $captain->name = 'jean Luc Picard';
//
//        DB::transaction(function() use ($ship, $captain) {
//            $ship = $ship->save(); //Ship Exists First
//            Ship::find($ship->id)->captain()->save($captain); //Captain is saved to existing ship
//        });
    }

    public function getUpdate($program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)
                        ->with('cover_media')
                        ->with('sessions')
                        ->with('resources')
                        ->with('authors')
                        ->with('accesss')
                        ->with('program_categories')
                        ->orderBy('id', 'desc')->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        $sessions = Session::orderBy('id', 'desc')->get();
        $roles = Role::orderBy('id', 'desc')->get();
        $resources = Resource::orderBy('id', 'desc')->get();
        $authors = User::where('role_id', 3)->orderBy('id', 'desc')->get();
        $program_categories = ProgramCategory::orderBy('id', 'desc')->get();
        return view('admin.program.update')
                        ->withPagetitle('Update Program')
                        ->withPageheader('Update Program')
                        ->withProgram($program)
                        ->withRoles($roles)
                        ->withProgramRoles(array_column(isset($program->accesss) ? $program->accesss->toArray() : [], 'role_id'))
                        ->withProgramSessions(array_column(isset($program->sessions) ? $program->sessions->toArray() : [], 'session_id'))
                        ->withProgramResources(array_column(isset($program->resources) ? $program->resources->toArray() : [], 'resource_id'))
                        ->withProgramAuthors(array_column(isset($program->authors) ? $program->authors->toArray() : [], 'user_id'))
                        ->withProgramCategoryMaps(array_column(isset($program->program_categories) ? $program->program_categories->toArray() : [], 'program_category_id'))
                        ->withSessions($sessions)
                        ->withResources($resources)
                        ->withAuthors($authors)
                        ->withProgramCategories($program_categories);
    }

    public function postUpdate(AdminProgramUpdateRequest $request, $program_unique_id) {
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new program and save it
        $program = Program::where('unique_id', $program_unique_id)->first();
        $program->id = $request->program_id;
        $program->slug = $request->slug ? $request->slug : Str::slug($request->title, '-');
        $program->title = $request->title;
        $program->title_alt = $request->title_alt;
        $program->description = $request->description;
        $program->cover_title = $request->cover_title;
        $program->tags = $_REQUEST['hidden-tags'];
        $program->created_by = auth()->user()->id;
        $program->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $program->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $program->save();

        ProgramAccessMap::where('program_id', $program->id)->delete();
        #save access for session
        if (isset($request->role_id)) {
            foreach ($request->role_id as $role_id) {
                $session_role = new ProgramAccessMap;
                $session_role->role_id = $role_id;
                $session_role->program_id = $program->id;
                $session_role->save();
            }
        }

        ProgramSessionMap::where('program_id', $program->id)->delete();
        #save sessions for program
        if (isset($request->session_id)) {
            foreach ($request->session_id as $session_id) {
                $program_session = new ProgramSessionMap;
                $program_session->session_id = $session_id;
                $program_session->program_id = $program->id;
                $program_session->save();
            }
        }
        ProgramAuthorMap::where('program_id', $program->id)->delete();
        #save authors for program
        if (isset($request->author_id)) {
            foreach ($request->author_id as $author_id) {
                $program_author = new ProgramAuthorMap;
                $program_author->user_id = $author_id;
                $program_author->program_id = $program->id;
                $program_author->save();
            }
        }
        ProgramCategoryMap::where('program_id', $program->id)->delete();
        #save program_categories for program
        if (isset($request->program_category_id)) {
            foreach ($request->program_category_id as $program_category_id) {
                $program_category_map = new ProgramCategoryMap;
                $program_category_map->program_category_id = $program_category_id;
                $program_category_map->program_id = $program->id;
                $program_category_map->save();
            }
        }
        ProgramResourceMap::where('program_id', $program->id)->delete();
        #save resources for program
        if (isset($request->resource_id)) {
            foreach ($request->resource_id as $resource_id) {
                $program_resource = new ProgramResourceMap;
                $program_resource->resource_id = $resource_id;
                $program_resource->program_id = $program->id;
                $program_resource->save();
            }
        }

        if (isset($request->cover_image)) {
            $program_cover_media_old = ProgramCoverMedia::where('program_id', $program->id)->first();
            if ($program_cover_media_old) {
                if (file_exists(config('constants.program.cover_path') . $program_cover_media_old->file))
                    unlink(config('constants.program.cover_path') . $program_cover_media_old->file);
                if (file_exists(config('constants.program.cover_path') . 'thumb_' . $program_cover_media_old->file))
                    unlink(config('constants.program.cover_path') . 'thumb_' . $program_cover_media_old->file);
                $program_cover_media_old->delete();
            }
            $imageName = strtolower($request->cover_image->getClientOriginalName());
            $destination = config('constants.program.cover_path');
            $i = 1;
            while (true) {
                if (!file_exists($destination . $imageName)) {
                    break;
                }
                $imageName = ++$i . $imageName;
            }
            $img = Image::make($request->cover_image->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save(config('constants.program.cover_path') . 'thumb_' . $imageName);

            $request->cover_image->move($destination, $imageName);
            $program_cover_media = new ProgramCoverMedia;
            $program_cover_media->unique_id = uniqid() . uniqid();
            $program_cover_media->program_id = $program->id;
            $program_cover_media->file = $imageName;
            $program_cover_media->created_by = auth()->user()->id;
            $program_cover_media->save();
        }

        return redirect()->route('admin.program.list')->with('success', 'Program has been updated.');
    }

    public function getCategoryCreate() {
        return view('admin.program.create')
                        ->withPagetitle('New Category')
                        ->withPageheader('New Category');
    }

    public function postCategoryCreate(Request $request) {
        
    }

    public function getCategoryUpdate($program_unique_id) {
        return view('admin.program.create')
                        ->withPagetitle('Update Category')
                        ->withPageheader('Update Category');
    }

    public function postCategoryUpdate(Request $request, $program_unique_id) {
        
    }

    public function getCoverUpdate($cover_unique_id) {
        $programCover = ProgramCoverMedia::where('unique_id', $cover_unique_id)->first();
        if (!$programCover)
            return redirect()->route('admin.program.list')->with('error', 'Program cover not found.');
        return view('admin.program.cover.edit')
                        ->withPagetitle('Update Cover Image')
                        ->withPageheader('Update Cover Image')
                        ->withProgramCover($programCover);
    }

}
