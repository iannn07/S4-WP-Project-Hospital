<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(Request $request)
    {
        $user = User::find(auth()->user()->id);
        return view('admin_dashboard', compact('user'));
    }
    public function profile(Request $request)
    {
        $user = User::find(auth()->user()->id);
        return view('admin_profile', compact('user'));
    }
    public function faq(Request $request)
    {
        $user = User::find(auth()->user()->id);
        return view('admin_faq', compact('user'));
    }
    public function doctor_table(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $doctor = Doctor::all();
        return view('admin_doctor_data', compact('user', 'doctor'));
    }
}
