<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller {

    public function getDashboard() {
        if (auth()->user()->role_id == 1)
            return redirect()->route('admin.dashboard');
        return view('user.dashboard.index')
                        ->withPagetitle('Dashboard')
                        ->withPageheader('Dashboard');
    }

}
