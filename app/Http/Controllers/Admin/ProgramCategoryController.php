<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProgramCategory;
use App\Http\Requests\AdminProgramCategoryCreateRequest;
use App\Http\Requests\AdminProgramCategoryUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ProgramCategoryController extends Controller {

    public function getCreate() {
        return view('admin.program.category.create')
                        ->withPagetitle('New Program Category')
                        ->withPageheader('New Program Category');
    }

    public function postCreate(AdminProgramCategoryCreateRequest $request) {
        // Retrieve the validated input data...
        $validation = $request->validated();

        // create new program and save it
        $program_category = new ProgramCategory;
        $program_category->unique_id = uniqid() . uniqid();
        $program_category->slug = Str::slug($request->title, '-');
        $program_category->title = $request->title;
        $program_category->created_by = auth()->user()->id;
        $program_category->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $program_category->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $program_category->save();

        return redirect()->route('admin.program.list')->with('success', 'Program Category has been added.');
    }

    public function getUpdate($program_category_unique_id) {
        $programCategory = ProgramCategory::where('unique_id', $program_category_unique_id)->first();
        return view('admin.program.category.update')
                        ->withPagetitle('Update Program Category')
                        ->withPageheader('Update Program Category')
                        ->withProgramCategory($programCategory);
    }

    public function postUpdate(AdminProgramCategoryUpdateRequest $request, $program_category_unique_id) {
        // Retrieve the validated input data...
        $validation = $request->validated();

        // update existing program category and save it
        $program_category = ProgramCategory::where('unique_id', $program_category_unique_id)->first();
        $program_category->slug = Str::slug($request->title, '-');
        $program_category->title = $request->title;
        $program_category->created_by = auth()->user()->id;
        $program_category->publish_on = $request->publish != '' ? Carbon::createFromFormat('Y-m-d H:i:s', $request->publish . ' 00:00:00') : Carbon::now();
        if ($request->unpublish != '') {
            $program_category->unpublish_on = Carbon::createFromFormat('Y-m-d H:i:s', $request->unpublish . ' 00:00:00');
        }
        $program_category->save();

        return redirect()->route('admin.program.list')->with('success', 'Program Category has been updated.');
    }

}
