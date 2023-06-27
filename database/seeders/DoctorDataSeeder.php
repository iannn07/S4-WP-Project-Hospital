<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use faker\Factory as Faker;

class DoctorDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('en_US');
        for ($i = 1; $i <= 10; $i++) {
            Doctor::create([
                'name' => 'Dr. ' . $faker->name . ', MD',
                'email' => $faker->unique()->email,
                'license' => $faker->bothify('25########'),
                'created_at' => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at' => Carbon::now()->timezone('Asia/Jakarta'),
            ]);
        }
    }
}
