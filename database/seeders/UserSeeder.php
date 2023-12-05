<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Renanda Matrisia',
                'email' => 'renanda@gmail.com',
                'phone' => '',
                'role' => 0,
                'password' => '12345678'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
