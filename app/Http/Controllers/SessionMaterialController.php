<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class SessionMaterialController extends Controller {

    public function index($session_slug, $type = '') {
        $session = Session::where('slug', $session_slug)->with('cover_media')->with('materials')->orderBy('id', 'desc')->first();

        return view('sessions.material')
                        ->withPagetitle($session->title)
                        ->withSession($session);
    }

}
