<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Http\Requests\AdminResourceCreateLocalRequest;
use App\Http\Requests\AdminResourceCreateMediaRequest;
use App\Http\Requests\AdminResourceCreateExternalRequest;
use App\Http\Requests\AdminResourceUpdateLocalRequest;
use App\Http\Requests\AdminResourceUpdateMediaRequest;
use App\Http\Requests\AdminResourceUpdateExternalRequest;
use App\Models\ResourceCoverMedia;
use App\Models\ResourceAttachment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;

class ResourceController extends Controller {

    public function getCreate() {
        return view('admin.resource.option')
                        ->withPagetitle('New Resource')
                        ->withPageheader('New Resource');
    }

    public function getCreateLocal() {
        return view('admin.resource.create.local')
                        ->withPagetitle('New Local Resource')
                        ->withPageheader('New Local Resource');
    }

    public function getCreateMedia() {
        return view('admin.resource.create.media')
                        ->withPagetitle('New Media Resource')
                        ->withPageheader('New Media Resource');
    }

    public function getCreateExternal() {
        return view('admin.resource.create.external')
                        ->withPagetitle('New External Resource')
                        ->withPageheader('New External Resource');
    }

    public function postCreateLocal(AdminResourceCreateLocalRequest $request) {
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
        $resource->save();

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
        return redirect()->route('admin.program.list')->with('success', 'Resource has been added.');
    }

    public function postCreateMedia(AdminResourceCreateMediaRequest $request) {
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
        $resource->save();

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
        return redirect()->route('admin.program.list')->with('success', 'Resource has been added.');
    }

    public function postCreateExternal(AdminResourceCreateExternalRequest $request) {
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
        $resource->save();

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
        return redirect()->route('admin.program.list')->with('success', 'Resource has been added.');
    }

    public function getUpdateLocal($resource_unique_id) {
        $resource = Resource::where('unique_id', $resource_unique_id)
                ->with('cover_media')
                ->with('attachment')
                ->first();
        return view('admin.resource.update.local')
                        ->withPagetitle('Update Local Resource')
                        ->withPageheader('Update Local Resource')
                        ->withResource($resource);
    }

    public function getUpdateMedia($resource_unique_id) {
        $resource = Resource::where('unique_id', $resource_unique_id)
                ->with('cover_media')
                ->with('attachment')
                ->first();
        return view('admin.resource.update.media')
                        ->withPagetitle('Update Media Resource')
                        ->withPageheader('Update Media Resource')
                        ->withResource($resource);
    }

    public function getUpdateExternal($resource_unique_id) {
        $resource = Resource::where('unique_id', $resource_unique_id)
                ->with('cover_media')
                ->with('attachment')
                ->first();
        return view('admin.resource.update.external')
                        ->withPagetitle('Update External Resource')
                        ->withPageheader('Update External Resource')
                        ->withResource($resource);
    }

    public function postUpdateLocal(AdminResourceUpdateLocalRequest $request, $resource_unique_id) {
        // Retrieve the validated input data...
        $validation = $request->validated();

        // create new resource and save it
        $resource = Resource::where('unique_id', $resource_unique_id)->first();
        $resource->id = $request->resource_id;
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
        return redirect()->route('admin.program.list')->with('success', 'Resource has been updated.');
    }

    public function postUpdateMedia(AdminResourceUpdateMediaRequest $request, $resource_unique_id) {
        // Retrieve the validated input data...
        $validation = $request->validated();

        // create new resource and save it

        $resource = Resource::where('unique_id', $resource_unique_id)->first();
        $resource->id = $request->resource_id;
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
        return redirect()->route('admin.program.list')->with('success', 'Resource has been updated.');
    }

    public function postUpdateExternal(AdminResourceUpdateExternalRequest $request, $resource_unique_id) {
        // Retrieve the validated input data...
        $validation = $request->validated();

        // create new resource and save it
        $resource = Resource::where('unique_id', $resource_unique_id)->first();
        $resource->id = $request->resource_id;
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
            $resource_cover_media_old = ProgramCoverMedia::where('resource_id', $resource->id)->first();
            if ($resource_cover_media_old) {
                if (file_exists(config('constants.resource.cover_path') . $resource_cover_media_old->file))
                    unlink(config('constants.resource.cover_path') . $resource_cover_media_old->file);
                if (file_exists(config('constants.resource.cover_path') . 'thumb_' . $resource_cover_media_old->file))
                    unlink(config('constants.resource.cover_path') . 'thumb_' . $resource_cover_media_old->file);
                $resource_cover_media_old->delete();
            }
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
            $resourceAttachment = ResourceAttachment::where('resource_id', $resource->id)->first();
            if (isset($resourceAttachment->file)) {
                if (is_file(config('constants.resource.attachment_path') . $resourceAttachment->file))
                    unlink(config('constants.resource.attachment_path') . $resourceAttachment->file);
                $resourceAttachment->delete();
            }

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
        return redirect()->route('admin.program.list')->with('success', 'Resource has been updated.');
    }

}
