<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123123123'),
            'visible_password' => '123123123',
            'occupation' => 'Developer',
            'address' => 'Dhaka, Bangladesh',
            'phone' => '01700000000',
            'email_verified_at' => NOW(),
            'is_admin' => 1,
        ]);
    }
}
