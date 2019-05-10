<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Support\Carbon;

class MediaController extends Controller {

    public function getAdd() {
        return view('admin.media.add')
                        ->withPagetitle('Upload Media')
                        ->withPageheader('Upload Media');
    }

    public function postAdd(Request $request) {
        if (isset($request->file)) {
            $fileName = strtolower($request->file->getClientOriginalName());
            $destination = config('constants.media.media_path');
            $i = 1;
            while (true) {
                if (!file_exists($destination . $fileName)) {
                    break;
                }
                $fileName = ++$i . $fileName;
            }
            $request->file->move($destination, $fileName);
            $filemedia = new Media;
            $filemedia->unique_id = uniqid() . uniqid();
            $filemedia->file = $fileName;
            $filemedia->save();
        }
    }

}
