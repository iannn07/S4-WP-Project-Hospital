<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use App\Models\Patient;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiagnoseController extends Controller
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
        $patients = Patient::with('diagnosis')->get();
        $patientSummary = $patients->map(function ($patient) {
            return [
                'name' => $patient->name,
                'dob' => $patient->dob,
                'gender' => $patient->gender,
                'room_id' => $patient->room_id,
                'doctor_id' => $patient->doctor_id,
                'diagnosis' => $patient->diagnosis->diagnosis,
                'diagnosis_description' => $patient->diagnosis->diagnosis_description,
            ];
        });
        return response()->json($patientSummary);
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
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient = Patient::with('diagnosis')->findOrFail($id);
        $patientSummary = [
                'name' => $patient->name,
                'dob' => $patient->dob,
                'gender' => $patient->gender,
                'room_id' => $patient->room_id,
                'doctor_id' => $patient->doctor_id,
                'diagnosis' => $patient->diagnosis->diagnosis,
                'diagnosis_description' => $patient->diagnosis->diagnosis_description,
            ];
        return response()->json($patientSummary);
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
        try{
            $validator = Validator::make($request->all(), [
                'diagnosis' => 'required',
                'description' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $updateDiagnosis = Diagnosis::where('patient_id', $id)->firstOrFail();
            $updateDiagnosis->diagnosis = $request->diagnosis;
            $updateDiagnosis->diagnosis_description = $request->description;
            $updateDiagnosis->save();

            return response()->json([
                'message' => 'SUCCESS',
                'new patient details' => [
                    'patient data' => $updateDiagnosis->load('diagnosis_patient'),
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
        abort(404);
    }
}
