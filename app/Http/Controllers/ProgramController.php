<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Session;
use App\Models\ProgramCategory;

class ProgramController extends Controller {

    public function index() {
        $programs = Program::with('cover_media')->orderBy('id', 'desc')->get();
        $programCategories = ProgramCategory::with('cover_media')->orderBy('id', 'desc')->get();
        return view('programs.index')
                        ->withPagetitle('Programs')
                        ->withPageheader('Programs')
                        ->withPrograms($programs)
                        ->withProgramCategories($programCategories);
    }

    public function detail($program_slug) {
        $program = Program::where('slug', $program_slug)->with('cover_media')->first();
        $sessions = Session::with('cover_media')->orderBy('id', 'asc')->get();
        return view('programs.detail')
                        ->withPagetitle($program->title)
                        ->withPageheader($program->title)
                        ->withProgram($program)
                        ->withSessions($sessions);
    }

}
