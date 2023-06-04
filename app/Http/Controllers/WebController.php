<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function admin(Request $request){
        return view('admin_dashboard');
    }
    public function profile(Request $request){
        return view('admin_profile');
    }
}
