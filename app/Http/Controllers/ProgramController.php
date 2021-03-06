<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Session;
use App\Models\ProgramCategory;
use App\Helpers\Helper;

class ProgramController extends Controller {

    public function index() {
        $programs = Program::where('status', '1')->with('cover_media')->with('access')->orderBy('id', 'desc')->get();
        $programCategories = ProgramCategory::orderBy('id', 'desc')->get();
        return view('programs.index')
                        ->withPagetitle('Programs')
                        ->withPageheader('Programs')
                        ->withPrograms($programs)
                        ->withProgramCategories($programCategories);
    }

    public function detail($program_slug) {
        $program = Program::where('slug', $program_slug)->with('cover_media')->with('sessions')->with('access')->first();

        if (!Helper::is_access_allowed(@$program->access[0]->role_id))
            return redirect()->route('unauthorize')->with('error', 'Program not accessable.');
        return view('programs.detail')
                        ->withPagetitle($program->title)
                        ->withPageheader($program->title)
                        ->withProgram($program)
                        ->withSessions($program->sessions);
    }

}
