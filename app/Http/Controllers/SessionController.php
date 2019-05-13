<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Session;
use App\Models\SessionCategory;

class SessionController extends Controller {

    public function index($program_slug) {
        $program = Program::where('slug', $program_slug)->with('cover_media')->with('access')->with('sessions')->first();
        $sessionCategories = SessionCategory::orderBy('id', 'desc')->get();
        return view('sessions.index')
                        ->withPagetitle($program->title)
                        ->withPageheader($program->title)
                        ->withProgram($program)
                        ->withSessionCategories($sessionCategories);
    }

}
