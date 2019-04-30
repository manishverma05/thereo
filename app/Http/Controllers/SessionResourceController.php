<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class SessionResourceController extends Controller {

    public function index($session_slug, $type = '') {
        $session = Session::where('slug', $session_slug)->with('cover_media')->with('resources')->orderBy('id', 'desc')->first();

        return view('sessions.resource')
                        ->withPagetitle($session->title)
                        ->withSession($session);
    }

}
