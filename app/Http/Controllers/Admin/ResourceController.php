<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResourceController extends Controller {

    public function getCreate() {
        return view('admin.resource.create')
                        ->withPagetitle('New Resource')
                        ->withPageheader('New Resource');
    }

    public function postCreate(AdminResourceCreateRequest $request) {
        // Retrieve the validated input data...
        $validation = $request->validated();

        // create new resource and save it
        $resource = new Resource;
        $resource->unique_id = uniqid() . uniqid();
        $resource->slug = $request->slug ? $request->slug : Str::slug($request->title, '-');
        $resource->title = $request->title;
        $resource->description = $request->description;
        $resource->created_by = auth()->user()->id;
        DB::transaction(function() use ($resource) {
            $resource = $resource->save();
        });
        return redirect()->route('admin.program.list');
    }

    public function getUpdate($resource_unique_id) {
        return view('admin.resource.create')
                        ->withPagetitle('New Resource')
                        ->withPageheader('New Resource');
    }

    public function postUpdate(Request $request, $resource_unique_id) {
        
    }

}
