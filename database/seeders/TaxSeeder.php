<?php

namespace Database\Seeders;

use App\Models\Tax;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taxes = [
            ['name' => '17% Tax', 'percentage' => 17],
            ['name' => '12% Tax', 'percentage' => 12],
            ['name' => '5% Tax', 'percentage' => 5],
            ['name' => 'No Tax', 'percentage' => 0],
        ];

        foreach ($taxes as $key => $tax) {
            Tax::updateOrCreate([
                'name' => $tax['name'],
                'percentage' => $tax['percentage']
            ]);
        }
    }
}
