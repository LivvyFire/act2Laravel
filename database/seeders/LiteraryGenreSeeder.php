<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LiteraryGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LiteraryGenre::create([
            'name' => 'Narrative',
            'description' => 'A narrator relates facts, real or fictitious'
        ]);
        LiteraryGenre::create([
            'name' => 'Lyrical',
            'description' => 'The author expresses his emotions or feelings in verse or prose'
        ]);
        LiteraryGenre::create([
            'name' => 'Dramatic',
            'description' => 'Combines literary art and performing art'
        ]);
        LiteraryGenre::create([
            'name' => 'Didactic',
            'description' => 'The main function is teaching or disseminating ideas'
        ]);
    }
}
