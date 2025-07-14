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
            ['id' => 1, 'name' => 'Respiratoire', 'category_id' => 1, 'slug' => 'respiratoire'],
            ['id' => 2, 'name' => 'Digestif', 'category_id' => 1, 'slug' => 'digestif'],
            ['id' => 3, 'name' => 'Tonifiant', 'category_id' => 1, 'slug' => 'tonifiant'],
            ['id' => 4, 'name' => 'Aromatique', 'category_id' => 2, 'slug' => 'aromatique'],
            ['id' => 5, 'name' => 'Culinaire', 'category_id' => 2, 'slug' => 'culinaire'],
        ]);
    }
}
