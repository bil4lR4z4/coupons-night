<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Super',
            'last_name'  => 'Admin',
            'username'   => 'admin',
            'email'      => 'admin@example.com',
            'role'       => 'admin',
            'status'     => 'active',
            'trash'      => 0,
            'password'   => Hash::make('12345678'),

        ]);
    }
}
