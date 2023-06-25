<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DataCounter extends Controller
{
    public function echart(Request $request)
    {
        $countDoctor = Doctor::query()->count();
        $countPatient = Patient::query()->count();
        return response()->json([
            'doctor' => $countDoctor,
            'patient' => $countPatient,
        ]);
    }
    /**
     * Truncate the entire table.
     *
     * @return \Illuminate\Http\Response
     */
    public function truncate()
    {
        Patient::query()->truncate();
        return redirect()->route('admin.patient.crud');
    }
}
