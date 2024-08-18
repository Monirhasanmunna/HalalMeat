<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Kilogram', 'short_name' => 'kg'],
            ['name' => 'Gram', 'short_name' => 'g'],
            ['name' => 'Milligram', 'short_name' => 'mg'],
            ['name' => 'Pound', 'short_name' => 'lb'],
        ];

        foreach ($units as $key => $unit) {
            Unit::updateOrCreate([
                'name' => $unit['name'],
                'short_name' => $unit['short_name']
            ]);
        }
    }
}
