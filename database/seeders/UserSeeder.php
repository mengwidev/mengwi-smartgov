<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@mengwismartgov.id',
            'username' => 'admin',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@mengwismartgov.id',
            'username' => 'user',
            'role' => 'user',
            'email_verified_at' => now(),
            'password' => Hash::make('user123'),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}