<?php

namespace Database\Seeders;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use faker\Factory as Faker;
use Ramsey\Uuid\Uuid;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patientIDs = DB::table('patients')->pluck('id');
        $faker = Faker::create('id_id');

        foreach ($patientIDs as $patientID) {
            Payment::create([
                'id' => Uuid::uuid4()->toString(),
                'patient_id' => $patientID,
                'full_amount' => $faker->numberBetween(1000000, 5000000000),
                'created_at' => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at' => Carbon::now()->timezone('Asia/Jakarta'),
            ]);
        }
    }
}
