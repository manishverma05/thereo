<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
//        $this->middleware('auth');
    }

    public function index() {
        return view('pages.home');
    }

    public function about() {
        return view('pages.about');
    }

    public function landingLogin() {
        return view('auth.login');
    }

    public function landing() {
        return view('pages.landing');
    }

    public function unauthorize() {
        return view('auth.unauthorize');
    }

}
