<?php

namespace Database\Seeders;

use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Unique;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctorID = DB::table('doctors')->pluck('id');
        $faker = Faker::create('zh_CN');
        for ($i = 1; $i <= 100; $i++) {
            $randomNumber = $faker->unique()->numerify('#########');
            $phone = "628" . $randomNumber;
            Patient::create([
                'name' => $faker->name,
                'doctor_id' => $faker->randomElement($doctorID),
                'phone' => $phone,
                'address' => $faker->unique()->address,
                'dob' => $faker->dateTimeThisCentury(),
                'gender' => $faker->randomElement(['M', 'F']),
                'created_at' => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at' => Carbon::now()->timezone('Asia/Jakarta'),
            ]);
        }
    }
}
