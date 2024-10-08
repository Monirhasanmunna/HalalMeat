<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Pharmacy'], 
            ['name' => 'Organic'],
            ['name' => 'Cosmetics'], 
            ['name' => 'Grocery'],
        ];

        foreach ($categories as $key => $category) {
            Category::updateOrCreate([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
            ]);
        }
    }
}
