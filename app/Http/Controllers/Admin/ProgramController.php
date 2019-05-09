<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProgramCategory;
use App\Models\Role;
use App\User;
use App\Models\Media;
use App\Models\ProgramMediaMap;
use App\Models\ProgramAuthorMap;
use App\Models\ProgramCategoryMap;
use App\Models\ProgramAccessMap;
use App\Models\ProgramUpdate;
use App\Http\Requests\AdminProgramCreateRequest;
use App\Http\Requests\AdminProgramUpdateRequest;
use App\Http\Requests\AdminProgramUpdateCreateRequest;
use App\Http\Requests\AdminProgramUpdateUpdateRequest;
use Illuminate\Support\Carbon;

//use App\Http\Requests\AdminProgramCategoryCreateRequest;
//use Illuminate\Support\Str;
//use Illuminate\Support\Carbon;
//use App\Models\ProgramCoverMedia;
//use App\Models\ProgramCategoryCoverMedia;
//use App\Models\Session;
//use App\Models\Resource;
//use Intervention\Image\Facades\Image;
//use App\Models\ProgramSessionMap;
//use App\Models\ProgramResourceMap;
//use App\Http\Requests\AdminProgramCategoryUpdateRequest;
//use Illuminate\Support\Facades\DB;
class ProgramController extends Controller {

    public function getList() {
        $programs = Program::with('cover_media')->with('creator')->with('program_categories')->orderBy('id', 'desc')->get();
        $program_categories = ProgramCategory::with('creator')->orderBy('id', 'desc')->get();
        return view('admin.program.index')
                        ->withPagetitle('Programs')
                        ->withPageheader('Programs')
                        ->withPrograms($programs)
                        ->withProgramCategories($program_categories);
    }

    public function getCreate() {
        $roles = Role::orderBy('id', 'desc')->get();
        $authors = User::where('role_id', 3)->orderBy('id', 'desc')->get();
        $galleries = Media::orderBy('id', 'desc')->get();
        $program_categories = ProgramCategory::orderBy('id', 'desc')->get();
        return view('admin.program.create')
                        ->withPagetitle('New Program')
                        ->withPageheader('New Program')
                        ->withRoles($roles)
                        ->withAuthors($authors)
                        ->withGalleries($galleries)
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
        $program->status = $request->status ? $request->status : '0';
        $program->save();
        
        #save access for program
        if (isset($request->role_id)) {
            foreach ($request->role_id as $role_id) {
                if ($role_id) {
                    $program_role = new ProgramAccessMap;
                    $program_role->role_id = $role_id;
                    $program_role->program_id = $program->id;
                    $program_role->save();
                }
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
        if ($request->cover_id) {
            $program_media_map = new ProgramMediaMap;
            $program_media_map->media_id = $request->cover_id;
            $program_media_map->program_id = $program->id;
            $program_media_map->type = 'cover';
            $program_media_map->save();
        }
        return redirect()->route('admin.program.list')->with('success', 'Program has been added.');
    }

    public function getUpdate($program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)
                ->with('cover_media')
                ->with('updates')
                ->with('sessions')
                ->with('resources')
                ->with('authors')
                ->with('access')
                ->with('program_categories')
                ->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        $galleries = Media::orderBy('id', 'desc')->get();
        $roles = Role::orderBy('id', 'desc')->get();
        $authors = User::where('role_id', 3)->orderBy('id', 'desc')->get();
        $program_categories = ProgramCategory::orderBy('id', 'desc')->get();
        return view('admin.program.update')
                        ->withPagetitle('Update Program')
                        ->withPageheader('Update Program')
                        ->withProgram($program)
                        ->withRoles($roles)
                        ->withProgramRoles(array_column(isset($program->access) ? $program->access->toArray() : [], 'role_id'))
                        ->withProgramSessions(array_column(isset($program->sessions) ? $program->sessions->toArray() : [], 'session_id'))
                        ->withProgramResources(array_column(isset($program->resources) ? $program->resources->toArray() : [], 'resource_id'))
                        ->withProgramAuthors(array_column(isset($program->authors) ? $program->authors->toArray() : [], 'user_id'))
                        ->withProgramCategoryMaps(array_column(isset($program->program_categories) ? $program->program_categories->toArray() : [], 'program_category_id'))
                        ->withAuthors($authors)
                        ->withGalleries($galleries)
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
        $program->status = $request->status ? $request->status : '0';
        $program->save();
        ProgramAccessMap::where('program_id', $program->id)->delete();
        #save access for program
        if (isset($request->role_id)) {
            foreach ($request->role_id as $role_id) {
                if ($role_id) {
                    $session_role = new ProgramAccessMap;
                    $session_role->role_id = $role_id;
                    $session_role->program_id = $program->id;
                    $session_role->save();
                }
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
        ProgramMediaMap::where('program_id', $program->id)->delete();
        if ($request->cover_id) {
            $program_media_map = new ProgramMediaMap;
            $program_media_map->media_id = $request->cover_id;
            $program_media_map->program_id = $program->id;
            $program_media_map->type = 'cover';
            $program_media_map->save();
        }
        return redirect()->route('admin.program.list')->with('success', 'Program has been updated.');
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

    public function getUpdateCreate($program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        return view('admin.program.update.create')
                        ->withPagetitle('Add Program Update')
                        ->withPageheader('Add Program Update')
                        ->withProgram($program);
    }

    public function postUpdateCreate(AdminProgramUpdateCreateRequest $request, $program_unique_id) {
        // Retrieve the validated input data...
        $validation = $request->validated();
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        // create new program and save it
        $program_update = new ProgramUpdate;
        $program_update->unique_id = uniqid() . uniqid();
        $program_update->title = $request->title;
        $program_update->program_id = $program->id;
        $program_update->description = $request->description;
        $program_update->created_by = auth()->user()->id;
        $program_update->save();
        return redirect()->route('admin.program.update', [$program->unique_id])->with('success', 'Program Update has been added.');
    }

    public function getUpdateUpdate($program_unique_id, $program_update_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        $program_update = ProgramUpdate::where('unique_id', $program_update_unique_id)->first();
        if (!$program_update)
            return redirect()->route('admin.program.list')->with('error', 'Program Update not found.');
        return view('admin.program.update.update')
                        ->withPagetitle('Update Program Update')
                        ->withPageheader('Update Program Update')
                        ->withProgram($program)
                        ->withProgramUpdate($program_update);
    }

    public function postUpdateUpdate(AdminProgramUpdateUpdateRequest $request, $program_unique_id, $program_update_unique_id) {
        // Retrieve the validated input data...
        $validation = $request->validated();
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        // create new program update and save it
        $program_update = ProgramUpdate::where('unique_id', $program_update_unique_id)->first();
        if (!$program_update)
            return redirect()->route('admin.program.list')->with('error', 'Program Update not found.');
        $program_update->title = $request->title;
        $program_update->description = $request->description;
        $program_update->modified_by = auth()->user()->id;
        $program_update->save();
        return redirect()->route('admin.program.update', [$program->unique_id])->with('success', 'Program Update has been updated.');
    }

}
