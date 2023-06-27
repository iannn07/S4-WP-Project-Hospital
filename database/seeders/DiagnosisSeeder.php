<?php

namespace Database\Seeders;

use App\Models\Diagnosis;
use App\Models\Doctor;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use faker\Factory as Faker;

class DiagnosisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();

        foreach ($patients as $patient) {
            $doctor = Doctor::find($patient->doctor_id);

            Diagnosis::create([
                'patient_id' => $patient->id,
                'doctor_id' => $doctor->id,
                'diagnosis' => 'N/A',
                'diagnosis_description' => 'N/A',
                'created_at' => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at' => Carbon::now()->timezone('Asia/Jakarta'),
            ]);
        }
    }
}
