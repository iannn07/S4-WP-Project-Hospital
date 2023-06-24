<?php

namespace Database\Seeders;

use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use faker\Factory as Faker;
use Ramsey\Uuid\Uuid;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patientIDs = DB::table('patients')->pluck('id');
        $faker = Faker::create('en_US');
        $roomTypes = [
            'General Ward',
            'Private Room',
            'Intensive Care Unit (ICU)',
            'Operating Room',
            'Emergency Room',
            'Labor and Delivery Room',
            'Pediatric Ward',
            'Cardiac Care Unit (CCU)',
            'Recovery Room',
            'Isolation Room',
            'Radiology Room',
        ];

        foreach ($patientIDs as $patientID) {
            Room::create([
                'id' => Uuid::uuid4()->toString(),
                'patient_id' => $patientID,
                'room_type' => $faker->randomElement($roomTypes),
                'created_at' => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at' => Carbon::now()->timezone('Asia/Jakarta'),
            ]);
        }
    }
}
