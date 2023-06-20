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
    public function admin_dashboard(Request $request)
    {
        $user = User::find(auth()->user()->id);
        return view('admin.admin_dashboard', compact('user'));
    }
    public function doctor_dashboard(Request $request)
    {
        $user = User::find(auth()->user()->id);
        return view('doctor.doctor_dashboard', compact('user'));
    }
    public function profile(Request $request)
    {
        $user = User::find(auth()->user()->id);
        return view('other.profile', compact('user'));
    }
    public function faq(Request $request)
    {
        $user = User::find(auth()->user()->id);
        return view('other.faq', compact('user'));
    }
    public function admin_doctor_data(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $doctor = Doctor::all();
        return view('admin.admin_doctor_data', compact('user', 'doctor'));
    }
    public function doctor_table_data(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $doctor = Doctor::all();
        return view('doctor.doctor_table_data', compact('user', 'doctor'));
    }
}
