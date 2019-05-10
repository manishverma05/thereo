<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Role;
use App\User;
use App\Models\SessionCategory;
use App\Models\Media;
use App\Models\Session;
use App\Models\ProgramSessionMap;
use App\Models\SessionAuthorMap;
use App\Models\SessionMediaMap;
use App\Models\Resource;
use App\Models\SessionResourceMap;
use App\Models\SessionAccessMap;
use App\Models\SessionCategoryMap;
use App\Http\Requests\AdminSessionCreateRequest;
use App\Http\Requests\AdminSessionUpdateRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

//use App\Models\SessionAttachment;
//use App\Models\SessionCoverMedia;
//use App\Models\Material;
//use App\Models\SessionMaterialMap;
//use Illuminate\Support\Carbon;
//use Intervention\Image\Facades\Image;
class SessionController extends Controller {

    public function getCreate($program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        $galleries = Media::orderBy('id', 'desc')->get();
        $roles = Role::orderBy('id', 'desc')->get();
        $authors = User::where('role_id', 3)->orderBy('id', 'desc')->get();
        $session_categories = SessionCategory::orderBy('id', 'desc')->get();
        return view('admin.session.create')
                        ->withPagetitle('New Session')
                        ->withPageheader('New Session')
                        ->withRoles($roles)
                        ->withAuthors($authors)
                        ->withProgram($program)
                        ->withAuthors($authors)
                        ->withGalleries($galleries)
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
        $session->status = $request->status ? $request->status : '0';
        $session->save();
        $program_session = new ProgramSessionMap;
        $program_session->session_id = $session->id;
        $program_session->program_id = $program->id;
        $program_session->save();
        #save access for session
        if (isset($request->role_id)) {
            foreach ($request->role_id as $role_id) {
                if ($role_id) {
                    $session_role = new SessionAccessMap;
                    $session_role->role_id = $role_id;
                    $session_role->session_id = $session->id;
                    $session_role->save();
                }
            }
        }
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
        if ($request->cover_id) {
            $session_media_map = new SessionMediaMap;
            $session_media_map->media_id = $request->cover_id;
            $session_media_map->session_id = $session->id;
            $session_media_map->type = 'cover';
            $session_media_map->save();
        }
        if ($request->video_id) {
            $session_media_map = new SessionMediaMap;
            $session_media_map->media_id = $request->video_id;
            $session_media_map->session_id = $session->id;
            $session_media_map->type = 'video';
            $session_media_map->save();
        }
        if ($request->material_id) {
            $session_media_map = new SessionMediaMap;
            $session_media_map->media_id = $request->material_id;
            $session_media_map->session_id = $session->id;
            $session_media_map->type = 'material';
            $session_media_map->save();
        }
        return redirect()->route('admin.program.update', [$program_unique_id])->with('success', 'Session has been added.');
    }

    public function getUpdate($program_unique_id, $session_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        $session = Session::where('unique_id', $session_unique_id)
                        ->with('cover_media')
                        ->with('material')
                        ->with('resources')
                        ->with('authors')
                        ->with('access')
                        ->with('video')
                        ->with('session_categories')
                        ->orderBy('id', 'desc')->first();
        if (!$session)
            return redirect()->route('admin.program.update', [$program_unique_id])->with('error', 'Session not found.');
        $roles = Role::orderBy('id', 'desc')->get();
        $galleries = Media::orderBy('id', 'desc')->get();
        $resources = Resource::orderBy('id', 'desc')->get();
        $authors = User::where('role_id', 3)->orderBy('id', 'desc')->get();
        $session_categories = SessionCategory::orderBy('id', 'desc')->get();
        return view('admin.session.update')
                        ->withPagetitle('Update Session')
                        ->withPageheader('Update Session')
                        ->withSession($session)
                        ->withProgram($program)
                        ->withSessionRoles(array_column(isset($session->access) ? $session->access->toArray() : [], 'role_id'))
                        ->withSessionAuthors(array_column(isset($session->authors) ? $session->authors->toArray() : [], 'user_id'))
                        ->withSessionCategoryMaps(array_column(isset($session->session_categories) ? $session->session_categories->toArray() : [], 'session_category_id'))
                        ->withRoles($roles)
                        ->withResources($resources)
                        ->withAuthors($authors)
                        ->withGalleries($galleries)
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
        #save access for session
        if (isset($request->role_id)) {
            foreach ($request->role_id as $role_id) {
                if ($role_id) {
                    $session_role = new SessionAccessMap;
                    $session_role->role_id = $role_id;
                    $session_role->session_id = $session->id;
                    $session_role->save();
                }
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
        SessionMediaMap::where('session_id', $session->id)->where('type', 'cover')->delete();
        if ($request->cover_id) {
            $session_media_map = new SessionMediaMap;
            $session_media_map->media_id = $request->cover_id;
            $session_media_map->session_id = $session->id;
            $session_media_map->type = 'cover';
            $session_media_map->save();
        }
        SessionMediaMap::where('session_id', $session->id)->where('type', 'video')->delete();
        if ($request->video_id) {
            $session_media_map = new SessionMediaMap;
            $session_media_map->media_id = $request->video_id;
            $session_media_map->session_id = $session->id;
            $session_media_map->type = 'video';
            $session_media_map->save();
        }
        SessionMediaMap::where('session_id', $session->id)->where('type', 'material')->delete();
        if ($request->material_id) {
            $session_media_map = new SessionMediaMap;
            $session_media_map->media_id = $request->material_id;
            $session_media_map->session_id = $session->id;
            $session_media_map->type = 'material';
            $session_media_map->save();
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
