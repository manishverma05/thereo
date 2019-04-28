<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;

class ProgramResourceController extends Controller {

    public function index($program_slug, $type = '') {
        $program = Program::where('slug', $program_slug)->with('cover_media')->with('resources')->orderBy('id', 'desc')->first();

        return view('programs.resource')
                        ->withPagetitle($program->title)
                        ->withProgram($program);
    }

}
