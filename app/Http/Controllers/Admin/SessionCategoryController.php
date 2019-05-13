<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SessionCategory;
use App\Http\Requests\AdminSessionCategoryCreateRequest;
use App\Http\Requests\AdminSessionCategoryUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class SessionCategoryController extends Controller {

    public function getCreate() {
        return view('admin.session.category.create')
                        ->withPagetitle('New Session Category')
                        ->withPageheader('New Session Category');
    }

    public function postCreate(AdminSessionCategoryCreateRequest $request) {
        // Retrieve the validated input data...
        $validation = $request->validated();
        // create new session and save it
        $session_category = new SessionCategory;
        $session_category->unique_id = uniqid() . uniqid();
        $session_category->slug = Str::slug($request->title, '-');
        $session_category->title = $request->title;
        $session_category->created_by = auth()->user()->id;
        $session_category->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $session_category->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $session_category->save();
        return redirect()->route('admin.session.list')->with('success', 'Session Category has been added.');
    }

    public function getUpdate($session_category_unique_id) {
        $sessionCategory = SessionCategory::where('unique_id', $session_category_unique_id)->first();
        return view('admin.session.category.update')
                        ->withPagetitle('Update Session Category')
                        ->withPageheader('Update Session Category')
                        ->withSessionCategory($sessionCategory);
    }

    public function postUpdate(AdminSessionCategoryUpdateRequest $request, $session_category_unique_id) {
        // Retrieve the validated input data...
        $validation = $request->validated();
        // update existing session category and save it
        $session_category = SessionCategory::where('unique_id', $session_category_unique_id)->first();
        $session_category->slug = Str::slug($request->title, '-');
        $session_category->title = $request->title;
        $session_category->created_by = auth()->user()->id;
        $session_category->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $session_category->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $session_category->save();
        return redirect()->route('admin.session.list')->with('success', 'Session Category has been updated.');
    }

}
