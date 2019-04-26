<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramCategory;
use App\Models\ProgramCategoryMap;
use App\Models\Program;

class ProgramCategoryController extends Controller {

    public function detail($category_slug) {
        $programCategory = ProgramCategory::where('slug', $category_slug)->with('cover_media')->first();
        $programCategories = ProgramCategory::with('cover_media')->orderBy('id', 'desc')->get();
        $programCategoryMap = ProgramCategoryMap::where('program_category_id',$programCategory->id)->with('program')->get();
        $programs = (object)array_column($programCategoryMap->toArray(),'program');
        return view('programs.index')
                        ->withPagetitle('Programs')
                        ->withPageheader('Programs')
                        ->withPrograms(json_decode(json_encode($programs)))
                        ->withProgramCategory($programCategory)
                        ->withProgramCategories($programCategories);
    }

}
