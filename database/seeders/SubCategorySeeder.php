<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::insert([
            ['id' => 1, 'name' => 'Respiratoire', 'category_id' => 1, 'slug' => 'respiratoire'],
            ['id' => 2, 'name' => 'Digestif', 'category_id' => 1, 'slug' => 'digestif'],
            ['id' => 3, 'name' => 'Tonifiant', 'category_id' => 1, 'slug' => 'tonifiant'],
            ['id' => 4, 'name' => 'Aromatique', 'category_id' => 2, 'slug' => 'aromatique'],
            ['id' => 5, 'name' => 'Culinaire', 'category_id' => 2, 'slug' => 'culinaire'],
        ]);
    }
}
