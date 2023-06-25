<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class PatientController extends Controller
{
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
        $doctor = Doctor::all();
        $room = Room::all();
        return view('admin.patient_data.pd_create', compact('user', 'doctor', 'room'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'date' => 'required',
            'gender' => 'required',
            'doctor' => 'required',
            'room' => 'required',
            'payment' => 'required',
        ]);

        $newPatient = new Patient();
        $newPatient->name = $validatedData['name'];
        $newPatient->phone = $validatedData['phone'];
        $newPatient->address = $validatedData['address'];
        $newPatient->dob = $validatedData['date'];
        $newPatient->gender = $validatedData['gender'];
        $newPatient->doctor_id = $validatedData['doctor'];
        $newPatient->room_id = $validatedData['room'];
        $newPatient->save();

        $newPayment = new Payment();
        $newPayment->id = Uuid::uuid4()->toString();
        $newPayment->patient_id = $newPatient->id;
        $newPayment->full_amount = $validatedData['payment'];
        $newPayment->save();

        return redirect()->route('admin.patient.crud');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find(auth()->user()->id);
        $patient = Patient::findOrFail($id);
        return view('admin.patient_data.pd_details', compact('user', 'patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find(auth()->user()->id);
        $doctor = Doctor::all();
        $room = Room::all();
        $patient = Patient::findOrFail($id);
        return view('admin.patient_data.pd_edit', compact('user', 'doctor', 'room', 'patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updatePatient = Patient::findOrFail($id);
        $updatePatient->name = $request->name;
        $updatePatient->phone = $request->phone;
        $updatePatient->address = $request->address;
        $updatePatient->dob = $request->date;
        $updatePatient->gender = $request->gender;
        $updatePatient->doctor_id = $request->doctor;
        $updatePatient->room_id = $request->room;
        $updatePatient->save();

        $updatePayment = Payment::where('patient_id', $id)->firstOrFail();
        $updatePayment->patient_id = $updatePatient->id;
        $updatePayment->full_amount = $request->payment;
        $updatePayment->save();

        return redirect()->route('admin.patient.crud');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletePatient = Patient::findOrFail($id);
        $deletePatient->delete();

        return redirect()->route('admin.patient.crud');
    }
}
