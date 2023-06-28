<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::with('payment', 'diagnosis')->get();
        return response()->json($patients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '*.name' => 'required',
            '*.phone' => 'required',
            '*.address' => 'required',
            '*.date' => 'required',
            '*.gender' => 'required',
            '*.doctor' => 'required',
            '*.room' => 'required',
            '*.payment' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $newPatients = [];

        foreach ($request->all() as $patientData) {
            $newPatient = new Patient();
            $newPatient->name = $patientData['name'];
            $newPatient->phone = $patientData['phone'];
            $newPatient->address = $patientData['address'];
            $newPatient->dob = $patientData['date'];
            $newPatient->gender = $patientData['gender'];
            $newPatient->doctor_id = $patientData['doctor'];
            $newPatient->room_id = $patientData['room'];
            $newPatient->save();

            $newPayment = new Payment();
            $newPayment->id = Uuid::uuid4()->toString();
            $newPayment->patient_id = $newPatient->id;
            $newPayment->full_amount = $patientData['payment'];
            $newPayment->save();

            $newDiagnosis = new Diagnosis();
            $newDiagnosis->patient_id = $newPatient->id;
            $newDiagnosis->doctor_id = $newPatient->doctor_id;
            $newDiagnosis->diagnosis = 'N/A';
            $newDiagnosis->diagnosis_description = 'N/A';
            $newDiagnosis->save();

            $newPatients[] = $newPatient->load('payment', 'diagnosis');
        }
        return response()->json([
            'message' => 'SUCCESS',
            'new patient details' => [
                'patient data' => $newPatients,
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $patient = Patient::with('payment', 'diagnosis')->findOrFail($id);
            return response()->json($patient);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Patient not found OR has been deleted'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'date' => 'required',
                'gender' => 'required',
                'doctor' => 'required',
                'room' => 'required',
                'payment' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

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
            $updatePayment->id = Uuid::uuid4()->toString();
            $updatePayment->patient_id = $updatePatient->id;
            $updatePayment->full_amount = $request->payment;
            $updatePayment->save();

            return response()->json([
                'message' => 'SUCCESS',
                'new patient details' => [
                    'patient data' => $updatePatient->load('payment'),
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Patient not found OR has been deleted'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deletePatient = Patient::findOrFail($id);
            $deletePatient->delete();

            return response()->json([
                'message' => 'SUCCESS',
                'deleted patient details' => $deletePatient,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Patient not found OR has been deleted'], 404);
        }
    }
}
