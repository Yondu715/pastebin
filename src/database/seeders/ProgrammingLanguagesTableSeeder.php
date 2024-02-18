<?php

namespace Database\Seeders;

use App\Models\ProgrammingLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgrammingLanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgrammingLanguage::query()->firstOrCreate([
            'name' => 'text'
        ]);
        ProgrammingLanguage::query()->firstOrCreate([
            'name' => 'html'
        ]);
        ProgrammingLanguage::query()->firstOrCreate([
            'name' => 'css'
        ]);
        ProgrammingLanguage::query()->firstOrCreate([
            'name' => 'java'
        ]);
        ProgrammingLanguage::query()->firstOrCreate([
            'name' => 'javascript'
        ]);
        ProgrammingLanguage::query()->firstOrCreate([
            'name' => 'typescript'
        ]);
        ProgrammingLanguage::query()->firstOrCreate([
            'name' => 'jsx'
        ]);
        ProgrammingLanguage::query()->firstOrCreate([
            'name' => 'tsx'
        ]);
        ProgrammingLanguage::query()->firstOrCreate([
            'name' => 'php'
        ]);
    }
}
