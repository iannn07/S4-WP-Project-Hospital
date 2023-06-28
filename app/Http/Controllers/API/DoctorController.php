<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
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
        $data = Doctor::all();
        return response($data);
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
            '*.email' => 'required',
            '*.license' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $newDoctors = [];

        foreach ($request->all() as $doctorData) {
            $newDoctor = new Doctor();
            $newDoctor->name = $doctorData['name'];
            $newDoctor->email = $doctorData['email'];
            $newDoctor->license = $doctorData['license'];
            $newDoctor->save();

            $newDoctors[] = $newDoctor;
        }

        return response()->json([
            'message' => 'SUCCESS',
            'new doctor details' => $newDoctors,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            return response()->json([
                'message' => 'SUCCESS',
                'doctor details' => $doctor,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Doctor not found OR has been deleted'], 404);
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
                'email' => 'required',
                'license' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $updateDoctor = Doctor::findOrFail($id);
            $updateDoctor->name = $request->name;
            $updateDoctor->email = $request->email;
            $updateDoctor->license = $request->license;
            $updateDoctor->save();

            return response()->json([
                'message' => 'SUCCESS',
                'new doctor details' => $updateDoctor,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Doctor not found OR has been deleted'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleteDoctor = Doctor::findOrFail($id);
            $deleteDoctor->delete();

            return response()->json([
                'message' => 'SUCCESS',
                'deleted doctor details' => $deleteDoctor,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Doctor not found OR has been deleted'], 404);
        }
    }
}
