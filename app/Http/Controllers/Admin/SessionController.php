<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;
use App\Models\Program;
use App\Models\Session;
use App\Models\SessionCategory;
use App\Models\SessionAuthorMap;
use App\Models\SessionAttachment;
use App\Models\SessionCategoryMap;
use App\Models\SessionAccessMap;
use App\Models\SessionCoverMedia;
use App\Models\ProgramSessionMap;
use App\Models\Material;
use App\Models\Resource;
use App\Models\SessionResourceMap;
use App\Models\SessionMaterialMap;
use App\Http\Requests\AdminSessionCreateRequest;
use App\Http\Requests\AdminSessionUpdateRequest;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class SessionController extends Controller {

    public function getCreate($program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        $roles = Role::orderBy('id', 'desc')->get();
        $authors = User::where('role_id', 3)->orderBy('id', 'desc')->get();
        $session_categories = SessionCategory::orderBy('id', 'desc')->get();
        return view('admin.session.create')
                        ->withPagetitle('New Session')
                        ->withPageheader('New Session')
                        ->withRoles($roles)
                        ->withAuthors($authors)
                        ->withSessionCategories($session_categories);
    }

    public function redirectSessionUpdate($session_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->with('program')->first();
        if (!$session)
            return redirect()->route('admin.program.update', [$program_unique_id])->with('error', 'Session not found.');
        return redirect()->route('admin.program.session.update', [$session->program->program->unique_id, $session->unique_id]);
    }

    public function postCreate(AdminSessionCreateRequest $request, $program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();

        // create new Session and save it
        $session = new Session;
        $session->unique_id = uniqid() . uniqid();
        $session->slug = $request->slug ? $request->slug : Str::slug($request->title, '-');
        $session->title = $request->title;
        $session->title_alt = $request->title_alt;
        $session->description = $request->description;
        $session->cover_title = $request->cover_title;
        $session->tags = $_REQUEST['hidden-tags'];
        $session->created_by = auth()->user()->id;
        $session->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $session->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        #temp
        $session->status = '1';
        $session->save();


        $program_session = new ProgramSessionMap;
        $program_session->session_id = $session->id;
        $program_session->program_id = $program->id;
        $program_session->save();

        #save authors for session
        if (isset($request->author_id)) {
            foreach ($request->author_id as $author_id) {
                $session_author = new SessionAuthorMap;
                $session_author->user_id = $author_id;
                $session_author->session_id = $session->id;
                $session_author->save();
            }
        }
        #save session_categories for session
        if (isset($request->session_category_id)) {
            foreach ($request->session_category_id as $session_category_id) {
                $session_category_map = new SessionCategoryMap;
                $session_category_map->session_category_id = $session_category_id;
                $session_category_map->session_id = $session->id;
                $session_category_map->save();
            }
        }

        if (isset($request->cover_image)) {
            $imageName = strtolower($request->cover_image->getClientOriginalName());
            $destination = config('constants.session.cover_path');
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
            })->save($destination . 'thumb_' . $imageName);

            $request->cover_image->move($destination, $imageName);
            $session_cover_media = new SessionCoverMedia;
            $session_cover_media->unique_id = uniqid() . uniqid();
            $session_cover_media->session_id = $session->id;
            $session_cover_media->file = $imageName;
            $session_cover_media->created_by = auth()->user()->id;
            $session_cover_media->save();
        }

        if (isset($request->video_attach)) {
            $videoName = strtolower($request->video_attach->getClientOriginalName());
            $destination = config('constants.session.video_path');

            $i = 1;
            while (true) {
                if (!file_exists($destination . $videoName)) {
                    break;
                }
                $videoName = ++$i . $videoName;
            }

            $request->video_attach->move($destination, $videoName);
            $session_media = new SessionAttachment;
            $session_media->unique_id = uniqid() . uniqid();
            $session_media->session_id = $session->id;
            $session_media->file = $videoName;
            $session_media->created_by = auth()->user()->id;
            $session_media->save();
        }
        return redirect()->route('admin.program.update', [$program_unique_id])->with('success', 'Session has been added.');
    }

    public function getUpdate($program_unique_id, $session_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');

        $session = Session::where('unique_id', $session_unique_id)
                        ->with('cover_media')
                        ->with('materials')
                        ->with('resources')
                        ->with('authors')
                        ->with('accesss')
                        ->with('attachment')
                        ->with('session_categories')
                        ->orderBy('id', 'desc')->first();
        if (!$session)
            return redirect()->route('admin.program.update', [$program_unique_id])->with('error', 'Session not found.');
        $materials = Material::orderBy('id', 'desc')->get();
        $roles = Role::orderBy('id', 'desc')->get();
        $resources = Resource::orderBy('id', 'desc')->get();
        $authors = User::where('role_id', 3)->orderBy('id', 'desc')->get();
        $session_categories = SessionCategory::orderBy('id', 'desc')->get();
        return view('admin.session.update')
                        ->withPagetitle('Update Session')
                        ->withPageheader('Update Session')
                        ->withSession($session)
                        ->withProgram($program)
                        ->withSessionRoles(array_column(isset($session->accesss) ? $session->accesss->toArray() : [], 'role_id'))
//                        ->withSessionMaterials(array_column(isset($session->materials) ? $session->materials->toArray() : [], 'material_id'))
//                        ->withSessionResources(array_column(isset($session->resources) ? $session->resources->toArray() : [], 'resource_id'))
                        ->withSessionAuthors(array_column(isset($session->authors) ? $session->authors->toArray() : [], 'user_id'))
                        ->withSessionCategoryMaps(array_column(isset($session->session_categories) ? $session->session_categories->toArray() : [], 'session_category_id'))
                        ->withMaterials($materials)
                        ->withRoles($roles)
                        ->withResources($resources)
                        ->withAuthors($authors)
                        ->withSessionCategories($session_categories);
    }

    public function postUpdate(AdminSessionUpdateRequest $request, $program_unique_id, $session_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');

        // Retrieve the validated input data...
        $validation = $request->validated();

        // create new Session and save it
        $session = Session::where('unique_id', $session_unique_id)->first();
        $session->slug = $request->slug ? $request->slug : Str::slug($request->title, '-');
        $session->title = $request->title;
        $session->title_alt = $request->title_alt;
        $session->description = $request->description;
        $session->cover_title = $request->cover_title;
        $session->tags = $_REQUEST['hidden-tags'];
        $session->created_by = auth()->user()->id;
        $session->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $session->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $session->save();

        SessionAccessMap::where('session_id', $session->id)->delete();
        #save access for session
        if (isset($request->role_id)) {
            foreach ($request->role_id as $role_id) {
                $session_role = new SessionAccessMap;
                $session_role->role_id = $role_id;
                $session_role->session_id = $session->id;
                $session_role->save();
            }
        }

        SessionAuthorMap::where('session_id', $session->id)->delete();
        #save authors for session
        if (isset($request->author_id)) {
            foreach ($request->author_id as $author_id) {
                $session_author = new SessionAuthorMap;
                $session_author->user_id = $author_id;
                $session_author->session_id = $session->id;
                $session_author->save();
            }
        }

        SessionCategoryMap::where('session_id', $session->id)->delete();
        #save session_categories for session
        if (isset($request->session_category_id)) {
            foreach ($request->session_category_id as $session_category_id) {
                $session_category_map = new SessionCategoryMap;
                $session_category_map->session_category_id = $session_category_id;
                $session_category_map->session_id = $session->id;
                $session_category_map->save();
            }
        }

        SessionResourceMap::where('session_id', $session->id)->delete();
        #save resources for session
        if (isset($request->resource_id)) {
            foreach ($request->resource_id as $resource_id) {
                $session_resource = new SessionResourceMap;
                $session_resource->resource_id = $resource_id;
                $session_resource->session_id = $session->id;
                $session_resource->save();
            }
        }

        SessionMaterialMap::where('session_id', $session->id)->delete();
        #save materials for session
        if (isset($request->material_id)) {
            foreach ($request->material_id as $material_id) {
                $session_material = new SessionMaterialMap;
                $session_material->material_id = $material_id;
                $session_material->session_id = $session->id;
                $session_material->save();
            }
        }

        if (isset($request->cover_image)) {
            $imageName = strtolower($request->cover_image->getClientOriginalName());
            $destination = config('constants.session.cover_path');
            $sessionCoverMedia = SessionCoverMedia::where('session_id', $session->id)->first();
            if (isset($sessionCoverMedia->file)) {
                if (is_file(config('constants.session.cover_path') . $sessionCoverMedia->file))
                    unlink(config('constants.session.cover_path') . $sessionCoverMedia->file);
                if (is_file(config('constants.session.cover_path') . 'thumb_' . $sessionCoverMedia->file))
                    unlink(config('constants.session.cover_path') . 'thumb_' . $sessionCoverMedia->file);
                $sessionCoverMedia->delete();
            }
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
            })->save($destination . 'thumb_' . $imageName);

            $request->cover_image->move($destination, $imageName);
            $session_cover_media = new SessionCoverMedia;
            $session_cover_media->unique_id = uniqid() . uniqid();
            $session_cover_media->session_id = $session->id;
            $session_cover_media->file = $imageName;
            $session_cover_media->created_by = auth()->user()->id;
            $session_cover_media->save();
        }

        if (isset($request->video_attach)) {
            $videoName = strtolower($request->video_attach->getClientOriginalName());
            $destination = config('constants.session.video_path');
            $sessionAttachment = SessionAttachment::where('session_id', $session->id)->first();
            if (isset($sessionAttachment->file)) {
                if (is_file(config('constants.session.video_path') . $sessionAttachment->file))
                    unlink(config('constants.session.video_path') . $sessionAttachment->file);
                $sessionAttachment->delete();
            }
            $i = 1;
            while (true) {
                if (!file_exists($destination . $videoName)) {
                    break;
                }
                $videoName = ++$i . $videoName;
            }

            $request->video_attach->move($destination, $videoName);
            $session_media = new SessionAttachment;
            $session_media->unique_id = uniqid() . uniqid();
            $session_media->session_id = $session->id;
            $session_media->file = $videoName;
            $session_media->created_by = auth()->user()->id;
            $session_media->save();
        }
        return redirect()->route('admin.program.update', [$program_unique_id])->with('success', 'Session has been updated.');
    }

    public function getVideoUpdate($attachment_unique_id) {
        $sessionAttachment = SessionAttachment::where('unique_id', $attachment_unique_id)->first();
        if (!$sessionAttachment)
            return redirect()->route('admin.program.list')->with('error', 'Session video not found.');
        return view('admin.session.video.edit')
                        ->withPagetitle('Update Video')
                        ->withPageheader('Update Video')
                        ->withSessionAttachment($sessionAttachment);
    }

    public function getCoverUpdate($cover_unique_id) {
        $sessionCover = SessionCoverMedia::where('unique_id', $cover_unique_id)->first();
        if (!$sessionCover)
            return redirect()->route('admin.program.list')->with('error', 'Session cover not found.');
        return view('admin.session.cover.edit')
                        ->withPagetitle('Update Cover Image')
                        ->withPageheader('Update Cover Image')
                        ->withSessionCover($sessionCover);
    }

}
