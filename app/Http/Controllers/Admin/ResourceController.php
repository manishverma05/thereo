<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\Program;
use App\Models\ResourceCoverMedia;
use App\Models\ResourceAttachment;
use App\Models\ProgramResourceMap;
use App\Http\Requests\AdminResourceCreateLocalRequest;
use App\Http\Requests\AdminResourceCreateMediaRequest;
use App\Http\Requests\AdminResourceCreateExternalRequest;
use App\Http\Requests\AdminResourceUpdateLocalRequest;
use App\Http\Requests\AdminResourceUpdateMediaRequest;
use App\Http\Requests\AdminResourceUpdateExternalRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;

class ResourceController extends Controller {

    public function getProgramCreate($program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        return view('admin.resource.option')
                        ->withPagetitle('New Resource')
                        ->withPageheader('New Resource')
                        ->withRelatedTo('program')
                        ->withProgram($program);
    }

    public function getCreateProgramLocal($program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        return view('admin.resource.create.local')
                        ->withPagetitle('New Local Resource')
                        ->withPageheader('New Local Resource')
                        ->withRelatedTo('program')
                        ->withProgram($program);
    }

    public function getCreateProgramMedia($program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        return view('admin.resource.create.media')
                        ->withPagetitle('New Media Resource')
                        ->withPageheader('New Media Resource')
                        ->withRelatedTo('program')
                        ->withProgram($program);
    }

    public function getCreateProgramExternal($program_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        return view('admin.resource.create.external')
                        ->withPagetitle('New External Resource')
                        ->withPageheader('New External Resource')
                        ->withRelatedTo('program')
                        ->withProgram($program);
    }

    public function postCreateProgramLocal(AdminResourceCreateLocalRequest $request, $program_unique_id) {
        // Retrieve the validated input data...
        $validation = $request->validated();
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');

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
        $resource->save();

        $program_resource = new ProgramResourceMap;
        $program_resource->resource_id = $resource->id;
        $program_resource->program_id = $program->id;
        $program_resource->save();

        if (isset($request->cover_image)) {
            $imageName = strtolower($request->cover_image->getClientOriginalName());
            $destination = config('constants.resource.cover_path');
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
            })->save(config('constants.resource.cover_path') . 'thumb_' . $imageName);

            $request->cover_image->move($destination, $imageName);
            $resource_cover_media = new ResourceCoverMedia;
            $resource_cover_media->unique_id = uniqid() . uniqid();
            $resource_cover_media->resource_id = $resource->id;
            $resource_cover_media->file = $imageName;
            $resource_cover_media->created_by = auth()->user()->id;
            $resource_cover_media->save();
        }
        if (isset($request->attachment)) {
            $attachmentName = strtolower($request->attachment->getClientOriginalName());
            $destination = config('constants.resource.attachment_path');

            $i = 1;
            while (true) {
                if (!file_exists($destination . $attachmentName)) {
                    break;
                }
                $attachmentName = ++$i . $attachmentName;
            }

            $request->attachment->move($destination, $attachmentName);
            $resource_media = new ResourceAttachment;
            $resource_media->unique_id = uniqid() . uniqid();
            $resource_media->resource_id = $resource->id;
            $resource_media->file = $attachmentName;
            $resource_media->created_by = auth()->user()->id;
            $resource_media->save();
        }
        return redirect()->route('admin.program.update', [$program->unique_id])->with('success', 'Program Resource has been added.');
    }

    public function postCreateProgramMedia(AdminResourceCreateMediaRequest $request, $program_unique_id) {
        // Retrieve the validated input data...
        $validation = $request->validated();
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');

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
        $resource->save();

        $program_resource = new ProgramResourceMap;
        $program_resource->resource_id = $resource->id;
        $program_resource->program_id = $program->id;
        $program_resource->save();

        if (isset($request->cover_image)) {
            $imageName = strtolower($request->cover_image->getClientOriginalName());
            $destination = config('constants.resource.cover_path');
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
            })->save(config('constants.resource.cover_path') . 'thumb_' . $imageName);

            $request->cover_image->move($destination, $imageName);
            $resource_cover_media = new ResourceCoverMedia;
            $resource_cover_media->unique_id = uniqid() . uniqid();
            $resource_cover_media->resource_id = $resource->id;
            $resource_cover_media->file = $imageName;
            $resource_cover_media->created_by = auth()->user()->id;
            $resource_cover_media->save();
        }
        return redirect()->route('admin.program.update', [$program->unique_id])->with('success', 'Program Resource has been added.');
    }

    public function postCreateProgramExternal(AdminResourceCreateExternalRequest $request, $program_unique_id) {
        // Retrieve the validated input data...
        $validation = $request->validated();
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');


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
        $resource->save();

        $program_resource = new ProgramResourceMap;
        $program_resource->resource_id = $resource->id;
        $program_resource->program_id = $program->id;
        $program_resource->save();

        if (isset($request->cover_image)) {
            $imageName = strtolower($request->cover_image->getClientOriginalName());
            $destination = config('constants.resource.cover_path');
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
            })->save(config('constants.resource.cover_path') . 'thumb_' . $imageName);

            $request->cover_image->move($destination, $imageName);
            $resource_cover_media = new ResourceCoverMedia;
            $resource_cover_media->unique_id = uniqid() . uniqid();
            $resource_cover_media->resource_id = $resource->id;
            $resource_cover_media->file = $imageName;
            $resource_cover_media->created_by = auth()->user()->id;
            $resource_cover_media->save();
        }
        return redirect()->route('admin.program.update', [$program->unique_id])->with('success', 'Program Resource has been added.');
    }

    public function getUpdateProgramLocal($program_unique_id, $resource_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        $resource = Resource::where('unique_id', $resource_unique_id)
                ->with('cover_media')
                ->with('attachment')
                ->first();
        return view('admin.resource.update.local')
                        ->withPagetitle('Update Local Resource')
                        ->withPageheader('Update Local Resource')
                        ->withResource($resource)
                        ->withRelatedTo('program')
                        ->withProgram($program);
    }

    public function getUpdateProgramMedia($program_unique_id, $resource_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        $resource = Resource::where('unique_id', $resource_unique_id)
                ->with('cover_media')
                ->with('attachment')
                ->first();
        return view('admin.resource.update.media')
                        ->withPagetitle('Update Media Resource')
                        ->withPageheader('Update Media Resource')
                        ->withResource($resource)
                        ->withRelatedTo('program')
                        ->withProgram($program);
    }

    public function getUpdateProgramExternal($program_unique_id, $resource_unique_id) {
        $program = Program::where('unique_id', $program_unique_id)->first();
        if (!$program)
            return redirect()->route('admin.program.list')->with('error', 'Program not found.');
        $resource = Resource::where('unique_id', $resource_unique_id)
                ->with('cover_media')
                ->with('attachment')
                ->first();
        return view('admin.resource.update.external')
                        ->withPagetitle('Update External Resource')
                        ->withPageheader('Update External Resource')
                        ->withResource($resource)
                        ->withRelatedTo('program')
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
        $resource->save();
        if (isset($request->cover_image)) {
            $resource_cover_media = ResourceCoverMedia::where('resource_id', $resource->id)->first();
            $destination = config('constants.resource.cover_path');
            if ($resource_cover_media) {
                if (file_exists($destination . $resource_cover_media->file))
                    unlink($destination . $resource_cover_media->file);
                if (file_exists($destination . 'thumb_' . $resource_cover_media->file))
                    unlink($destination . 'thumb_' . $resource_cover_media->file);
            }
            $imageName = strtolower($request->cover_image->getClientOriginalName());
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
            })->save(config('constants.resource.cover_path') . 'thumb_' . $imageName);

            $request->cover_image->move($destination, $imageName);
            if(!$resource_cover_media)
                $resource_cover_media = new ResourceCoverMedia;
            $resource_cover_media->resource_id = $resource->id;
            $resource_cover_media->file = $imageName;
            $resource_cover_media->created_by = auth()->user()->id;
            $resource_cover_media->save();
        }
        if (isset($request->attachment)) {
            $destination = config('constants.resource.attachment_path');
            $resource_media = ResourceAttachment::where('resource_id', $resource->id)->first();
            if ($resource_media) {
                if (file_exists($destination . $resource_media->file))
                    unlink($destination . $resource_media->file);
                if (file_exists($destination . 'thumb_' . $resource_media->file))
                    unlink($destination . 'thumb_' . $resource_media->file);
            }
            $attachmentName = strtolower($request->attachment->getClientOriginalName());
            $i = 1;
            while (true) {
                if (!file_exists($destination . $attachmentName)) {
                    break;
                }
                $attachmentName = ++$i . $attachmentName;
            }

            $request->attachment->move($destination, $attachmentName);
            if(!$resource_media)
                $resource_media = new ResourceAttachment;
            $resource_media->resource_id = $resource->id;
            $resource_media->file = $attachmentName;
            $resource_media->created_by = auth()->user()->id;
            $resource_media->save();
        }
        return redirect()->route('admin.program.update', [$program->unique_id])->with('success', 'Program Resource has been updated.');
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
        $resource->type = 'local';
        $resource->description = '';
        $resource->cover_title = $request->cover_title;
        $resource->created_by = auth()->user()->id;
        $resource->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $resource->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $resource->save();

        if (isset($request->cover_image)) {
            $resource_cover_media = ResourceCoverMedia::where('resource_id', $resource->id)->first();
            $destination = config('constants.resource.cover_path');
            if ($resource_cover_media) {
                if (file_exists($destination . $resource_cover_media->file))
                    unlink($destination . $resource_cover_media->file);
                if (file_exists($destination . 'thumb_' . $resource_cover_media->file))
                    unlink($destination . 'thumb_' . $resource_cover_media->file);
            }
            $imageName = strtolower($request->cover_image->getClientOriginalName());
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
            })->save(config('constants.resource.cover_path') . 'thumb_' . $imageName);

            $request->cover_image->move($destination, $imageName);
            if(!$resource_cover_media)
                $resource_cover_media = new ResourceCoverMedia;
            $resource_cover_media->resource_id = $resource->id;
            $resource_cover_media->file = $imageName;
            $resource_cover_media->created_by = auth()->user()->id;
            $resource_cover_media->save();
        }
        if (isset($request->attachment)) {
            $destination = config('constants.resource.attachment_path');
            $resource_media = ResourceAttachment::where('resource_id', $resource->id)->first();
            if ($resource_media) {
                if (file_exists($destination . $resource_media->file))
                    unlink($destination . $resource_media->file);
                if (file_exists($destination . 'thumb_' . $resource_media->file))
                    unlink($destination . 'thumb_' . $resource_media->file);
            }
            $attachmentName = strtolower($request->attachment->getClientOriginalName());

            $i = 1;
            while (true) {
                if (!file_exists($destination . $attachmentName)) {
                    break;
                }
                $attachmentName = ++$i . $attachmentName;
            }

            $request->attachment->move($destination, $attachmentName);
            if(!$resource_media)
                $resource_media = new ResourceAttachment;
            $resource_media->resource_id = $resource->id;
            $resource_media->file = $attachmentName;
            $resource_media->created_by = auth()->user()->id;
            $resource_media->save();
        }
        return redirect()->route('admin.program.update', [$program->unique_id])->with('success', 'Program Resource has been updated.');
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
        $resource->type = 'local';
        $resource->description = '';
        $resource->cover_title = $request->cover_title;
        $resource->created_by = auth()->user()->id;
        $resource->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $resource->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $resource->save();

        if (isset($request->cover_image)) {
            $resource_cover_media = ResourceCoverMedia::where('resource_id', $resource->id)->first();
            $destination = config('constants.resource.cover_path');
            if ($resource_cover_media) {
                if (file_exists($destination . $resource_cover_media->file))
                    unlink($destination . $resource_cover_media->file);
                if (file_exists($destination . 'thumb_' . $resource_cover_media->file))
                    unlink($destination . 'thumb_' . $resource_cover_media->file);
            }
            $imageName = strtolower($request->cover_image->getClientOriginalName());
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
            })->save(config('constants.resource.cover_path') . 'thumb_' . $imageName);

            $request->cover_image->move($destination, $imageName);
            if(!$resource_cover_media)
                $resource_cover_media = new ResourceCoverMedia;
            $resource_cover_media->resource_id = $resource->id;
            $resource_cover_media->file = $imageName;
            $resource_cover_media->created_by = auth()->user()->id;
            $resource_cover_media->save();
        }
        if (isset($request->attachment)) {
            $destination = config('constants.resource.attachment_path');
            $resource_media = ResourceAttachment::where('resource_id', $resource->id)->first();
            if ($resource_media) {
                if (file_exists($destination . $resource_media->file))
                    unlink($destination . $resource_media->file);
                if (file_exists($destination . 'thumb_' . $resource_media->file))
                    unlink($destination . 'thumb_' . $resource_media->file);
            }
            $attachmentName = strtolower($request->attachment->getClientOriginalName());
            $i = 1;
            while (true) {
                if (!file_exists($destination . $attachmentName)) {
                    break;
                }
                $attachmentName = ++$i . $attachmentName;
            }

            $request->attachment->move($destination, $attachmentName);
            if(!$resource_media)
                $resource_media = new ResourceAttachment;
            $resource_media->resource_id = $resource->id;
            $resource_media->file = $attachmentName;
            $resource_media->created_by = auth()->user()->id;
            $resource_media->save();
        }
        return redirect()->route('admin.program.update', [$program->unique_id])->with('success', 'Program Resource has been updated.');
    }

}
