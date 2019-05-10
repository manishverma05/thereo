<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Session;
use App\Models\SessionMaterialMap;
use App\Models\MaterialCoverMedia;
use App\Models\MaterialAttachment;
use App\Http\Requests\AdminMaterialCreateMediaRequest;
use App\Http\Requests\AdminMaterialUpdateMediaRequest;
use App\Http\Requests\AdminMaterialCreateExternalRequest;
use App\Http\Requests\AdminMaterialUpdateExternalRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class MaterialController extends Controller {

    public function getSessionCreate($session_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        return view('admin.material.option')
                        ->withPagetitle('New Material')
                        ->withPageheader('New Material')
                        ->withRelatedTo('session')
                        ->withSession($session);
    }

    public function getCreateSessionMedia($session_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        return view('admin.material.create.media')
                        ->withPagetitle('New Media Material')
                        ->withPageheader('New Media Material')
                        ->withRelatedTo('session')
                        ->withSession($session);
    }

    public function getCreateSessionExternal($session_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        return view('admin.material.create.external')
                        ->withPagetitle('New External Material')
                        ->withPageheader('New External Material')
                        ->withRelatedTo('session')
                        ->withSession($session);
    }

    public function postCreateSessionMedia(AdminMaterialCreateMediaRequest $request, $session_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new material and save it
        $material = new Material;
        $material->unique_id = uniqid() . uniqid();
        $material->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $material->title = $request->title;
        $material->type = 'media';
        $material->description = '';
        $material->cover_title = $request->cover_title;
        $material->created_by = auth()->user()->id;
        $material->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $material->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $material->status = '1';
        $material->save();
        $session_material = new SessionMaterialMap;
        $session_material->material_id = $material->id;
        $session_material->session_id = $session->id;
        $session_material->save();
        if (isset($request->cover_image)) {
            $imageName = strtolower($request->cover_image->getClientOriginalName());
            $destination = config('constants.material.cover_path');
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
            })->save(config('constants.material.cover_path') . 'thumb_' . $imageName);
            $request->cover_image->move($destination, $imageName);
            $material_cover_media = new MaterialCoverMedia;
            $material_cover_media->unique_id = uniqid() . uniqid();
            $material_cover_media->material_id = $material->id;
            $material_cover_media->file = $imageName;
            $material_cover_media->created_by = auth()->user()->id;
            $material_cover_media->save();
        }
        if (isset($request->attachment)) {
            $attachmentName = strtolower($request->attachment->getClientOriginalName());
            $destination = config('constants.material.attachment_path');
            $i = 1;
            while (true) {
                if (!file_exists($destination . $attachmentName)) {
                    break;
                }
                $attachmentName = ++$i . $attachmentName;
            }
            $request->attachment->move($destination, $attachmentName);
            $material_media = new MaterialAttachment;
            $material_media->unique_id = uniqid() . uniqid();
            $material_media->material_id = $material->id;
            $material_media->file = $attachmentName;
            $material_media->created_by = auth()->user()->id;
            $material_media->save();
        }
        return redirect()->route('admin.session.update', [$session->unique_id])->with('success', 'Session Material has been added.');
    }

    public function postCreateSessionExternal(AdminMaterialCreateExternalRequest $request, $session_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();

        // create new material and save it
        $material = new Material;
        $material->unique_id = uniqid() . uniqid();
        $material->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $material->title = $request->title;
        $material->type = 'external';
        $material->description = '';
        $material->cover_title = $request->cover_title;
        $material->created_by = auth()->user()->id;
        $material->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $material->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $material->status = '1';
        $material->save();
        $session_material = new SessionMaterialMap;
        $session_material->material_id = $material->id;
        $session_material->session_id = $session->id;
        $session_material->save();
        if (isset($request->cover_image)) {
            $imageName = strtolower($request->cover_image->getClientOriginalName());
            $destination = config('constants.material.cover_path');
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
            })->save(config('constants.material.cover_path') . 'thumb_' . $imageName);
            $request->cover_image->move($destination, $imageName);
            $material_cover_media = new MaterialCoverMedia;
            $material_cover_media->unique_id = uniqid() . uniqid();
            $material_cover_media->material_id = $material->id;
            $material_cover_media->file = $imageName;
            $material_cover_media->created_by = auth()->user()->id;
            $material_cover_media->save();
        }
        if (isset($request->attachment)) {
            $attachmentName = strtolower($request->attachment->getClientOriginalName());
            $destination = config('constants.material.attachment_path');
            $i = 1;
            while (true) {
                if (!file_exists($destination . $attachmentName)) {
                    break;
                }
                $attachmentName = ++$i . $attachmentName;
            }
            $request->attachment->move($destination, $attachmentName);
            $material_media = new MaterialAttachment;
            $material_media->unique_id = uniqid() . uniqid();
            $material_media->material_id = $material->id;
            $material_media->file = $attachmentName;
            $material_media->created_by = auth()->user()->id;
            $material_media->save();
        }
        return redirect()->route('admin.session.update', [$session->unique_id])->with('success', 'Session Material has been added.');
    }

    public function getUpdateSessionMedia($session_unique_id, $material_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        $material = Material::where('unique_id', $material_unique_id)
                ->with('cover_media')
                ->with('attachment')
                ->first();
        return view('admin.material.update.media')
                        ->withPagetitle('Update Media Material')
                        ->withPageheader('Update Media Material')
                        ->withMaterial($material)
                        ->withRelatedTo('session')
                        ->withSession($session);
    }

    public function getUpdateSessionExternal($session_unique_id, $material_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        $material = Material::where('unique_id', $material_unique_id)
                ->with('cover_media')
                ->with('attachment')
                ->first();
        return view('admin.material.update.external')
                        ->withPagetitle('Update External Material')
                        ->withPageheader('Update External Material')
                        ->withMaterial($material)
                        ->withRelatedTo('session')
                        ->withSession($session);
    }

    public function postUpdateSessionMedia(AdminMaterialUpdateMediaRequest $request, $session_unique_id, $material_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new material and save it
        $material = Material::where('unique_id', $material_unique_id)->first();
        $material->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $material->title = $request->title;
        $material->type = 'media';
        $material->description = '';
        $material->cover_title = $request->cover_title;
        $material->created_by = auth()->user()->id;
        $material->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $material->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $material->status = '1';
        $material->save();
        if (isset($request->cover_image)) {
            $material_cover_media = MaterialCoverMedia::where('material_id', $material->id)->first();
            $destination = config('constants.material.cover_path');
            if ($material_cover_media) {
                if (file_exists($destination . $material_cover_media->file))
                    unlink($destination . $material_cover_media->file);
                if (file_exists($destination . 'thumb_' . $material_cover_media->file))
                    unlink($destination . 'thumb_' . $material_cover_media->file);
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
            })->save(config('constants.material.cover_path') . 'thumb_' . $imageName);
            $request->cover_image->move($destination, $imageName);
            if (!$material_cover_media) {
                $material_cover_media = new MaterialCoverMedia;
                $material_cover_media->unique_id = uniqid() . uniqid();
            }
            $material_cover_media->material_id = $material->id;
            $material_cover_media->file = $imageName;
            $material_cover_media->created_by = auth()->user()->id;
            $material_cover_media->save();
        }
        if (isset($request->attachment)) {
            $destination = config('constants.material.attachment_path');
            $material_media = MaterialAttachment::where('material_id', $material->id)->first();
            if ($material_media) {
                if (file_exists($destination . $material_media->file))
                    unlink($destination . $material_media->file);
                if (file_exists($destination . 'thumb_' . $material_media->file))
                    unlink($destination . 'thumb_' . $material_media->file);
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
            if (!$material_media) {
                $material_media = new MaterialAttachment;
                $material_media->unique_id = uniqid() . uniqid();
            }
            $material_media->material_id = $material->id;
            $material_media->file = $attachmentName;
            $material_media->created_by = auth()->user()->id;
            $material_media->save();
        }
        return redirect()->route('admin.session.update', [$session->unique_id])->with('success', 'Session Material has been updated.');
    }

    public function postUpdateSessionExternal(AdminMaterialUpdateExternalRequest $request, $session_unique_id, $material_unique_id) {
        $session = Session::where('unique_id', $session_unique_id)->first();
        if (!$session)
            return redirect()->route('admin.session.list')->with('error', 'Session not found.');
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new material and save it
        $material = Material::where('unique_id', $material_unique_id)->first();
        $material->slug = $request->slug ? $request->slug : Str::slug($request->title, '-') . uniqid();
        $material->title = $request->title;
        $material->type = 'external';
        $material->description = '';
        $material->cover_title = $request->cover_title;
        $material->created_by = auth()->user()->id;
        $material->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $material->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $material->status = '1';
        $material->save();
        if (isset($request->cover_image)) {
            $material_cover_media = MaterialCoverMedia::where('material_id', $material->id)->first();
            $destination = config('constants.material.cover_path');
            if ($material_cover_media) {
                if (file_exists($destination . $material_cover_media->file))
                    unlink($destination . $material_cover_media->file);
                if (file_exists($destination . 'thumb_' . $material_cover_media->file))
                    unlink($destination . 'thumb_' . $material_cover_media->file);
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
            })->save(config('constants.material.cover_path') . 'thumb_' . $imageName);
            $request->cover_image->move($destination, $imageName);
            if (!$material_cover_media) {
                $material_cover_media = new MaterialCoverMedia;
                $material_cover_media->unique_id = uniqid() . uniqid();
            }
            $material_cover_media->material_id = $material->id;
            $material_cover_media->file = $imageName;
            $material_cover_media->created_by = auth()->user()->id;
            $material_cover_media->save();
        }
        if (isset($request->attachment)) {
            $destination = config('constants.material.attachment_path');
            $material_media = MaterialAttachment::where('material_id', $material->id)->first();
            if ($material_media) {
                if (file_exists($destination . $material_media->file))
                    unlink($destination . $material_media->file);
                if (file_exists($destination . 'thumb_' . $material_media->file))
                    unlink($destination . 'thumb_' . $material_media->file);
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
            if (!$material_media) {
                $material_media = new MaterialAttachment;
                $material_media->unique_id = uniqid() . uniqid();
            }
            $material_media->material_id = $material->id;
            $material_media->file = $attachmentName;
            $material_media->created_by = auth()->user()->id;
            $material_media->save();
        }
        return redirect()->route('admin.session.update', [$session->unique_id])->with('success', 'Session Material has been updated.');
    }

}
