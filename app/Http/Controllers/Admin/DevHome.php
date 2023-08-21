<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Meta;
use Illuminate\Http\Request;

class DevHome extends Controller
{
    private function meta(){
        $meta = Meta::$data_meta;
        $meta['title'] = 'Admin | Home';
        return $meta;
    }

    public function index(){
        return view('admin.home',[
            "meta" => $this->meta(),
        ]);
    }
}
