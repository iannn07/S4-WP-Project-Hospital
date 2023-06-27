<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
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
    public function create($patient)
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
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find(auth()->user()->id);
        $patient = Patient::findOrFail($id);
        return view('doctor.diagnosis_data.dg_edit', compact('user', 'patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateDiagnosis = Diagnosis::where('patient_id', $id)->firstOrFail();
        $updateDiagnosis->diagnosis = $request->diagnosis;
        $updateDiagnosis->diagnosis_description = $request->description;
        $updateDiagnosis->save();

        return redirect()->route('doctor.doctor.diagnosis');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort(404);
    }
}
