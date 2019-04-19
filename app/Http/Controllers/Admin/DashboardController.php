<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {

    public function getDashboard() {
        return view('admin.dashboard.index')
                        ->withPagetitle('Dashboard')
                        ->withPageheader('Dashboard');
    }

    public function getlogout() {
        Auth::logout();
        return redirect()->route('login');
//        $user = auth()->user();
//        Auth::logout();
//        return view('auth.user_out')->withUser($user);
    }

    public function getAdminLanding() {
        return view('auth.user_landing');
    }

}
