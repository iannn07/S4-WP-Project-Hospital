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

        foreach ($roomTypes as $roomType) {
            Room::create([
                'room_type' => $roomType,
                'created_at' => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at' => Carbon::now()->timezone('Asia/Jakarta'),
            ]);
        }
    }
}
