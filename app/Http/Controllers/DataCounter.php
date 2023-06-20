<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DataCounter extends Controller
{
    public function echart(Request $request)
    {
        $countDoctor = Doctor::query()->count();
        return response()->json([
            'doctor' => $countDoctor,
        ]);
    }
}
