<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Désactiver les vérifications de clés étrangères pour permettre le truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('sub_categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        SubCategory::insert([
            ['id' => 1, 'name' => 'Respiratory', 'category_id' => 1, 'slug' => 'respiratory'],
            ['id' => 2, 'name' => 'Digestive', 'category_id' => 1, 'slug' => 'digestive'],
            ['id' => 3, 'name' => 'Tonic', 'category_id' => 1, 'slug' => 'tonic'],
            ['id' => 4, 'name' => 'Aromatic', 'category_id' => 2, 'slug' => 'aromatic'],
            ['id' => 5, 'name' => 'Culinary', 'category_id' => 2, 'slug' => 'culinary'],
        ]);
    }
}
