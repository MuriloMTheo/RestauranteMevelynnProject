<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create or update the admin user
        User::updateOrCreate(
            ['email' => 'admin@hotmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'), // change after seeding
                'is_admin' => true,
            ]
        );
    }
}
