<?php

namespace Database\Seeders;

use App\Models\AccessRestriction;
use Illuminate\Database\Seeder;

class AccessRestrictionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccessRestriction::query()->firstOrCreate([
            'name' => 'public'
        ]);
        AccessRestriction::query()->firstOrCreate([
            'name' => 'unlisted'
        ]);
        AccessRestriction::query()->firstOrCreate([
            'name' => 'private'
        ]);
    }
}
