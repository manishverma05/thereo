<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\Program;
use App\Models\ResourceMediaMap;
use App\Models\Media;
use App\Models\ProgramResourceMap;
use App\Models\Session;
use App\Models\SessionResourceMap;
use App\Http\Requests\AdminResourceCreateLocalRequest;
use App\Http\Requests\AdminResourceCreateMediaRequest;
use App\Http\Requests\AdminResourceCreateExternalRequest;
use App\Http\Requests\AdminResourceUpdateLocalRequest;
use App\Http\Requests\AdminResourceUpdateMediaRequest;
use App\Http\Requests\AdminResourceUpdateExternalRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ResourceController extends Controller {

    public function getCreateProgramLocal($program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        $galleries = Media::orderBy('id', 'desc')->get();
        return view('admin.resource.create.local')
                        ->withPagetitle('New Local Resource')
                        ->withPageheader('New Local Resource')
                        ->withRelatedTo('program')
                        ->withGalleries($galleries)
                        ->withProgram($program);
    }

    public function postCreateProgramLocal(AdminResourceCreateLocalRequest $request, $program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new resource and save it
        $resource = new Resource;
        $resource->unique_id = uniqid() . uniqid();
        $resource->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $resource->title = $request->title;
        $resource->type = 'local';
        $resource->description = '';
        $resource->cover_title = $request->cover_title;
        $resource->created_by = auth()->user()->id;
        $resource->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $resource->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $resource->status = $request->status ? $request->status : '0';
        $resource->save();
        $program_resource = new ProgramResourceMap;
        $program_resource->resource_id = $resource->id;
        $program_resource->program_id = $program->id;
        $program_resource->save();

        if ($request->product_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->product_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'product';
            $resource_media_map->save();
        }
        return redirect()->route('admin.program.update', [$program->unique_id])->with('success', 'Program Resource has been added.');
    }

    public function getUpdateProgramLocal($program_unique_id, $resource_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        $resource = Resource::where('unique_id', $resource_unique_id)
                ->with('product')
                ->first();
        $galleries = Media::orderBy('id', 'desc')->get();
        return view('admin.resource.update.local')
                        ->withPagetitle('Update Local Resource')
                        ->withPageheader('Update Local Resource')
                        ->withResource($resource)
                        ->withRelatedTo('program')
                        ->withGalleries($galleries)
                        ->withProgram($program);
    }

    public function postUpdateProgramLocal(AdminResourceUpdateLocalRequest $request, $program_unique_id, $resource_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new resource and save it
        $resource = Resource::where('unique_id', $resource_unique_id)->first();
        $resource->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $resource->title = $request->title;
        $resource->type = 'local';
        $resource->description = '';
        $resource->cover_title = $request->cover_title;
        $resource->created_by = auth()->user()->id;
        $resource->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $resource->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $resource->status = $request->status ? $request->status : '0';
        $resource->save();
        ResourceMediaMap::where('resource_id', $resource->id)->where('type', 'product')->delete();
        if ($request->product_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->product_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'product';
            $resource_media_map->save();
        }
        return redirect()->route('admin.program.update', [$program->unique_id])->with('success', 'Program Resource has been updated.');
    }

    public function getCreateProgramMedia($program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        $galleries = Media::orderBy('id', 'desc')->get();
        return view('admin.resource.create.media')
                        ->withPagetitle('New Media Resource')
                        ->withPageheader('New Media Resource')
                        ->withRelatedTo('program')
                        ->withGalleries($galleries)
                        ->withProgram($program);
    }

    public function postCreateProgramMedia(AdminResourceCreateMediaRequest $request, $program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new resource and save it
        $resource = new Resource;
        $resource->unique_id = uniqid() . uniqid();
        $resource->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $resource->title = $request->title;
        $resource->type = 'media';
        $resource->description = '';
        $resource->cover_title = $request->cover_title;
        $resource->created_by = auth()->user()->id;
        $resource->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $resource->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $resource->status = '1';
        $resource->save();
        $program_resource = new ProgramResourceMap;
        $program_resource->resource_id = $resource->id;
        $program_resource->program_id = $program->id;
        $program_resource->save();
        if ($request->media_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->media_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'media';
            $resource_media_map->save();
        }
        if ($request->cover_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->cover_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'cover';
            $resource_media_map->save();
        }
        return redirect()->route('admin.program.update', [$program->unique_id])->with('success', 'Program Resource has been added.');
    }

    public function getUpdateProgramMedia($program_unique_id, $resource_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        $resource = Resource::where('unique_id', $resource_unique_id)
                ->with('cover_media')
                ->with('media')
                ->first();
        $galleries = Media::orderBy('id', 'desc')->get();
        return view('admin.resource.update.media')
                        ->withPagetitle('Update Media Resource')
                        ->withPageheader('Update Media Resource')
                        ->withResource($resource)
                        ->withRelatedTo('program')
                        ->withGalleries($galleries)
                        ->withProgram($program);
    }

    public function postUpdateProgramMedia(AdminResourceUpdateMediaRequest $request, $program_unique_id, $resource_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new resource and save it
        $resource = Resource::where('unique_id', $resource_unique_id)->first();
        $resource->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $resource->title = $request->title;
        $resource->type = 'media';
        $resource->description = '';
        $resource->cover_title = $request->cover_title;
        $resource->created_by = auth()->user()->id;
        $resource->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $resource->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $resource->status = '1';
        $resource->save();

        ResourceMediaMap::where('resource_id', $resource->id)->where('type', 'media')->delete();
        if ($request->media_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->media_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'media';
            $resource_media_map->save();
        }
        ResourceMediaMap::where('resource_id', $resource->id)->where('type', 'cover')->delete();
        if ($request->cover_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->cover_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'cover';
            $resource_media_map->save();
        }

        return redirect()->route('admin.program.update', [$program->unique_id])->with('success', 'Program Resource has been updated.');
    }

    public function getCreateProgramExternal($program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        $galleries = Media::orderBy('id', 'desc')->get();
        return view('admin.resource.create.external')
                        ->withPagetitle('New External Resource')
                        ->withPageheader('New External Resource')
                        ->withRelatedTo('program')
                        ->withGalleries($galleries)
                        ->withProgram($program);
    }

    public function postCreateProgramExternal(AdminResourceCreateExternalRequest $request, $program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new resource and save it
        $resource = new Resource;
        $resource->unique_id = uniqid() . uniqid();
        $resource->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $resource->title = $request->title;
        $resource->type = 'external';
        $resource->description = '';
        $resource->cover_title = $request->cover_title;
        $resource->created_by = auth()->user()->id;
        $resource->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $resource->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $resource->status = $request->status ? $request->status : '0';
        $resource->save();
        $program_resource = new ProgramResourceMap;
        $program_resource->resource_id = $resource->id;
        $program_resource->program_id = $program->id;
        $program_resource->save();

        if ($request->external_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->external_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'external';
            $resource_media_map->save();
        }
        if ($request->cover_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->cover_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'cover';
            $resource_media_map->save();
        }
        return redirect()->route('admin.program.update', [$program->unique_id])->with('success', 'Program Resource has been added.');
    }

    public function getUpdateProgramExternal($program_unique_id, $resource_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        $resource = Resource::where('unique_id', $resource_unique_id)
                ->with('external')
                ->first();
        $galleries = Media::orderBy('id', 'desc')->get();
        return view('admin.resource.update.external')
                        ->withPagetitle('Update External Resource')
                        ->withPageheader('Update External Resource')
                        ->withResource($resource)
                        ->withRelatedTo('program')
                        ->withGalleries($galleries)
                        ->withProgram($program);
    }

    public function postUpdateProgramExternal(AdminResourceUpdateExternalRequest $request, $program_unique_id, $resource_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new resource and save it
        $resource = Resource::where('unique_id', $resource_unique_id)->first();
        $resource->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $resource->title = $request->title;
        $resource->type = 'external';
        $resource->description = '';
        $resource->cover_title = $request->cover_title;
        $resource->created_by = auth()->user()->id;
        $resource->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $resource->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $resource->status = $request->status ? $request->status : '0';
        $resource->save();

        ResourceMediaMap::where('resource_id', $resource->id)->where('type', 'external')->delete();
        if ($request->external_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->external_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'external';
            $resource_media_map->save();
        }
        ResourceMediaMap::where('resource_id', $resource->id)->where('type', 'cover')->delete();
        if ($request->cover_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->cover_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'cover';
            $resource_media_map->save();
        }
        return redirect()->route('admin.program.update', [$program->unique_id])->with('success', 'Program Resource has been updated.');
    }

    public function getCreateSessionLocal($session_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        $galleries = Media::orderBy('id', 'desc')->get();
        return view('admin.resource.create.local')
                        ->withPagetitle('New Local Resource')
                        ->withPageheader('New Local Resource')
                        ->withRelatedTo('session')
                        ->withGalleries($galleries)
                        ->withSession($session);
    }

    public function postCreateSessionLocal(AdminResourceCreateLocalRequest $request, $session_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new resource and save it
        $resource = new Resource;
        $resource->unique_id = uniqid() . uniqid();
        $resource->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $resource->title = $request->title;
        $resource->type = 'local';
        $resource->description = '';
        $resource->cover_title = $request->cover_title;
        $resource->created_by = auth()->user()->id;
        $resource->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $resource->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $resource->status = $request->status ? $request->status : '0';
        $resource->save();
        $session_resource = new SessionResourceMap;
        $session_resource->resource_id = $resource->id;
        $session_resource->session_id = $session->id;
        $session_resource->save();

        if ($request->product_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->product_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'product';
            $resource_media_map->save();
        }
        return redirect()->route('admin.session.update', [$session->unique_id])->with('success', 'Session Resource has been added.');
    }

    public function getUpdateSessionLocal($session_unique_id, $resource_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        $resource = Resource::where('unique_id', $resource_unique_id)
                ->with('product')
                ->first();
        $galleries = Media::orderBy('id', 'desc')->get();
        return view('admin.resource.update.local')
                        ->withPagetitle('Update Local Resource')
                        ->withPageheader('Update Local Resource')
                        ->withResource($resource)
                        ->withRelatedTo('session')
                        ->withGalleries($galleries)
                        ->withSession($session);
    }

    public function postUpdateSessionLocal(AdminResourceUpdateLocalRequest $request, $session_unique_id, $resource_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new resource and save it
        $resource = Resource::where('unique_id', $resource_unique_id)->first();
        $resource->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $resource->title = $request->title;
        $resource->type = 'local';
        $resource->description = '';
        $resource->cover_title = $request->cover_title;
        $resource->created_by = auth()->user()->id;
        $resource->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $resource->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $resource->status = $request->status ? $request->status : '0';
        $resource->save();
        ResourceMediaMap::where('resource_id', $resource->id)->where('type', 'product')->delete();
        if ($request->product_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->product_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'product';
            $resource_media_map->save();
        }
        return redirect()->route('admin.session.update', [$session->unique_id])->with('success', 'Session Resource has been updated.');
    }

    public function getCreateSessionMedia($session_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        $galleries = Media::orderBy('id', 'desc')->get();
        return view('admin.resource.create.media')
                        ->withPagetitle('New Media Resource')
                        ->withPageheader('New Media Resource')
                        ->withRelatedTo('session')
                        ->withGalleries($galleries)
                        ->withSession($session);
    }

    public function postCreateSessionMedia(AdminResourceCreateMediaRequest $request, $session_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new resource and save it
        $resource = new Resource;
        $resource->unique_id = uniqid() . uniqid();
        $resource->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $resource->title = $request->title;
        $resource->type = 'media';
        $resource->description = '';
        $resource->cover_title = $request->cover_title;
        $resource->created_by = auth()->user()->id;
        $resource->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $resource->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $resource->status = '1';
        $resource->save();
        $session_resource = new SessionResourceMap;
        $session_resource->resource_id = $resource->id;
        $session_resource->session_id = $session->id;
        $session_resource->save();
        if ($request->media_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->media_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'media';
            $resource_media_map->save();
        }
        if ($request->cover_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->cover_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'cover';
            $resource_media_map->save();
        }
        return redirect()->route('admin.session.update', [$session->unique_id])->with('success', 'Session Resource has been added.');
    }

    public function getUpdateSessionMedia($session_unique_id, $resource_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        $resource = Resource::where('unique_id', $resource_unique_id)
                ->with('cover_media')
                ->with('media')
                ->first();
        $galleries = Media::orderBy('id', 'desc')->get();
        return view('admin.resource.update.media')
                        ->withPagetitle('Update Media Resource')
                        ->withPageheader('Update Media Resource')
                        ->withResource($resource)
                        ->withRelatedTo('session')
                        ->withGalleries($galleries)
                        ->withSession($session);
    }

    public function postUpdateSessionMedia(AdminResourceUpdateMediaRequest $request, $session_unique_id, $resource_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new resource and save it
        $resource = Resource::where('unique_id', $resource_unique_id)->first();
        $resource->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $resource->title = $request->title;
        $resource->type = 'media';
        $resource->description = '';
        $resource->cover_title = $request->cover_title;
        $resource->created_by = auth()->user()->id;
        $resource->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $resource->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $resource->status = '1';
        $resource->save();

        ResourceMediaMap::where('resource_id', $resource->id)->where('type', 'media')->delete();
        if ($request->media_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->media_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'media';
            $resource_media_map->save();
        }
        ResourceMediaMap::where('resource_id', $resource->id)->where('type', 'cover')->delete();
        if ($request->cover_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->cover_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'cover';
            $resource_media_map->save();
        }

        return redirect()->route('admin.session.update', [$session->unique_id])->with('success', 'Session Resource has been updated.');
    }

    public function getCreateSessionExternal($session_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        $galleries = Media::orderBy('id', 'desc')->get();
        return view('admin.resource.create.external')
                        ->withPagetitle('New External Resource')
                        ->withPageheader('New External Resource')
                        ->withRelatedTo('session')
                        ->withGalleries($galleries)
                        ->withSession($session);
    }

    public function postCreateSessionExternal(AdminResourceCreateExternalRequest $request, $session_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new resource and save it
        $resource = new Resource;
        $resource->unique_id = uniqid() . uniqid();
        $resource->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $resource->title = $request->title;
        $resource->type = 'external';
        $resource->description = '';
        $resource->cover_title = $request->cover_title;
        $resource->created_by = auth()->user()->id;
        $resource->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $resource->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $resource->status = $request->status ? $request->status : '0';
        $resource->save();
        $session_resource = new SessionResourceMap;
        $session_resource->resource_id = $resource->id;
        $session_resource->session_id = $session->id;
        $session_resource->save();

        if ($request->external_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->external_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'external';
            $resource_media_map->save();
        }
        if ($request->cover_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->cover_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'cover';
            $resource_media_map->save();
        }
        return redirect()->route('admin.session.update', [$session->unique_id])->with('success', 'Session Resource has been added.');
    }

    public function getUpdateSessionExternal($session_unique_id, $resource_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        $resource = Resource::where('unique_id', $resource_unique_id)
                ->with('external')
                ->first();
        $galleries = Media::orderBy('id', 'desc')->get();
        return view('admin.resource.update.external')
                        ->withPagetitle('Update External Resource')
                        ->withPageheader('Update External Resource')
                        ->withResource($resource)
                        ->withRelatedTo('session')
                        ->withGalleries($galleries)
                        ->withSession($session);
    }

    public function postUpdateSessionExternal(AdminResourceUpdateExternalRequest $request, $session_unique_id, $resource_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new resource and save it
        $resource = Resource::where('unique_id', $resource_unique_id)->first();
        $resource->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $resource->title = $request->title;
        $resource->type = 'external';
        $resource->description = '';
        $resource->cover_title = $request->cover_title;
        $resource->created_by = auth()->user()->id;
        $resource->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $resource->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $resource->status = $request->status ? $request->status : '0';
        $resource->save();

        ResourceMediaMap::where('resource_id', $resource->id)->where('type', 'external')->delete();
        if ($request->external_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->external_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'external';
            $resource_media_map->save();
        }
        ResourceMediaMap::where('resource_id', $resource->id)->where('type', 'cover')->delete();
        if ($request->cover_id) {
            $resource_media_map = new ResourceMediaMap;
            $resource_media_map->media_id = $request->cover_id;
            $resource_media_map->resource_id = $resource->id;
            $resource_media_map->type = 'cover';
            $resource_media_map->save();
        }
        return redirect()->route('admin.session.update', [$session->unique_id])->with('success', 'Session Resource has been updated.');
    }

}
