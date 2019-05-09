<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Helper {

    public static function is_access_allowed($access_type = '') {
        if (!$access_type)
            return true;
        if (!isset(auth()->user()->role_id) && $access_type)
            return false;
        if (auth()->user()->role_id == $access_type || auth()->user()->role_id == 1)
            return true;
        return false;
    }

}
