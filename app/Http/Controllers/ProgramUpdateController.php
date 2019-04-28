<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;

class ProgramUpdateController extends Controller {

    public function index($program_slug, $type = '') {
        $program = Program::where('slug', $program_slug)->with('updates')->orderBy('id', 'desc')->first();

        return view('programs.update')
                        ->withPagetitle($program->title)
                        ->withProgram($program);
    }

}
