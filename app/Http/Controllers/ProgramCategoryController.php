<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramCategory;
use App\Models\ProgramCategoryMap;
use App\Models\Program;

class ProgramCategoryController extends Controller {

    public function detail($category_slug) {
        $programCategory = ProgramCategory::where('slug', $category_slug)->first();
        $programs = Program::where('status', '1')->with('cover_media')->with('access')
                        ->where('program_category_id', $programCategory->id)
                        ->join('program_category_maps as pcm', 'pcm.program_id', '=', 'programs.id')
                        ->with('access')->orderBy('id', 'desc')->select(
                        'programs.*')->get();
        $programCategories = ProgramCategory::orderBy('id', 'desc')->get();
        return view('programs.index')
                        ->withPagetitle('Programs')
                        ->withPageheader('Programs')
                        ->withPrograms($programs)
                        ->withProgramCategory($programCategory)
                        ->withProgramCategories($programCategories);
    }

}
