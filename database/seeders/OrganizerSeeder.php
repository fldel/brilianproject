<?php

namespace Database\Seeders;

use App\Models\Organizer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OrganizerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organizer::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );
    }
}
