<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $view_type = "dashboard";
        return view('backend.dashboard',compact('view_type'));
    }
}
