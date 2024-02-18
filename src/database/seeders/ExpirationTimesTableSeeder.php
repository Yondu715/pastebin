<?php

namespace Database\Seeders;

use App\Models\ExpirationTime;
use Illuminate\Database\Seeder;

class ExpirationTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExpirationTime::query()->firstOrCreate([
            'name' => '10 мин',
            'minutes' => 10
        ]);
        ExpirationTime::query()->firstOrCreate([
            'name' => '1 час',
            'minutes' => 60
        ]);
        ExpirationTime::query()->firstOrCreate([
            'name' => '3 часа',
            'minutes' => 180
        ]);
        ExpirationTime::query()->firstOrCreate([
            'name' => '1 день',
            'minutes' => 1440
        ]);
        ExpirationTime::query()->firstOrCreate([
            'name' => '1 неделя',
            'minutes' => 10080
        ]);
        ExpirationTime::query()->firstOrCreate([
            'name' => '1 месяц',
            'minutes' => 43800
        ]);
        ExpirationTime::query()->firstOrCreate([
            'name' => 'без ограничения',
            'minutes' => null
        ]);
    }
}
