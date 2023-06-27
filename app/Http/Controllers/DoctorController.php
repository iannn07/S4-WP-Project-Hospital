<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::find(auth()->user()->id);
        return view('doctor.doctor_data.dr_create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'license' => 'required',
            'email' => 'required',
        ]);

        $newDoctor = new Doctor();
        $newDoctor->name = $validatedData['name'];
        $newDoctor->license = $validatedData['license'];
        $newDoctor->email = $validatedData['email'];
        $newDoctor->save();

        return redirect()->route('doctor.doctor.table');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find(auth()->user()->id);
        $doctor = Doctor::findOrFail($id);
        return view('doctor.doctor_data.dr_edit', compact('user', 'doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateDoctor = Doctor::findOrFail($id);
        $updateDoctor->name = $request->name;
        $updateDoctor->license = $request->license;
        $updateDoctor->email = $request->email;
        $updateDoctor->save();

        return redirect()->route('doctor.doctor.table');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteDoctor = Doctor::findOrFail($id);
        $deleteDoctor->delete();

        return redirect()->route('doctor.doctor.table');
    }
}
