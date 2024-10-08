<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::updateOrCreate([
            'category_id' => 1,
            'name' => 'Vegitable'
        ]);

        SubCategory::updateOrCreate([
            'category_id' => 1,
            'name' => 'Meat'
        ]);
    }
}
