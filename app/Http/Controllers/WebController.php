<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
    public function admin_dashboard(Request $request)
    {
        $user = User::find(auth()->user()->id);
        return view('admin.admin_dashboard', compact('user'));
    }
    public function admin_doctor_data(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $doctor = Doctor::all();
        return view('admin.admin_doctor_data', compact('user', 'doctor'));
    }
    public function admin_patient_view(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $patient = Patient::all();
        return view('admin.admin_patient_view', compact('user', 'patient'));
    }
    public function admin_patient_crud(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $patient = Patient::all();
        return view('admin.admin_patient_crud', compact('user', 'patient'));
    }
    public function admin_room_view(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $patient = Patient::count();
        $room = Room::all();
        return view('admin.admin_room_view', compact('user', 'patient', 'room'));
    }
    public function admin_room_crud(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $room = Room::all();
        return view('admin.admin_room_crud', compact('user', 'room'));
    }
    public function doctor_dashboard(Request $request)
    {
        $user = User::find(auth()->user()->id);
        return view('doctor.doctor_dashboard', compact('user'));
    }
    public function doctor_table_data(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $doctor = Doctor::all();
        return view('doctor.doctor_table_data', compact('user', 'doctor'));
    }
}
