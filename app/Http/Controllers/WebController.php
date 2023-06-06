<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function admin(Request $request){
        $user = User::find(auth()->user()->id);
        return view('admin_dashboard', compact('user'));
    }
    public function profile(Request $request)
    {
        $user = User::find(auth()->user()->id);
        return view('admin_profile', compact('user'));
    }
}
