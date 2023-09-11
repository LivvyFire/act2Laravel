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
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@filament.test',
            'is_reader' => true,
        ]);
        User::factory()->create([
            'name' => 'ReaderOne',
            'email' => 'readone@filament.test',
            'is_reader' => false,
        ]);
        User::factory()->create([
            'name' => 'ReaderTwo',
            'email' => 'readtwo@filament.test',
            'is_reader' => true,
        ]);
    }
}
