<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function getlogout() {
        $user = auth()->user();
        Auth::logout();
        return view('auth.user_out')->withUser($user);
    }

}
