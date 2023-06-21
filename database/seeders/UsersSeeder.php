<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Admin HMS',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('roottoor'),
                'about' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'role' => 0,
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Doctor HMS',
                'email' => 'doctor@gmail.com',
                'password' => bcrypt('toorroot'),
                'about' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'role' => 1,
            ],
        ]);
    }
}
