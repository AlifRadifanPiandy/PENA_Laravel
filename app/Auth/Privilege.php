<?php

namespace App\Auth;

use Illuminate\Support\Facades\Auth;

class Privilege
{

    public static function get($p)
    {
        $auth = Auth::guard('admin')->user();
        $privilege = explode(",", $auth->privilege);
        if (in_array($p, $privilege)) {
            return true;
        } else {
            return false;
        }
    }

}
