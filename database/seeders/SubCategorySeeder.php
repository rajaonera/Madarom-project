<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('sub_categories')->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        SubCategory::insert([
            ['id' => 1, 'name' => 'Respiratory', 'name_fr' => 'Respiratoire', 'category_id' => 1, 'slug' => 'respiratoire'],
            ['id' => 2, 'name' => 'Digestive',   'name_fr' => 'Digestif',      'category_id' => 1, 'slug' => 'digestif'],
            ['id' => 3, 'name' => 'Energizing',  'name_fr' => 'Tonifiant',     'category_id' => 1, 'slug' => 'tonifiant'],
            ['id' => 4, 'name' => 'Aromatic',    'name_fr' => 'Aromatique',    'category_id' => 2, 'slug' => 'aromatique'],
            ['id' => 5, 'name' => 'Culinary',    'name_fr' => 'Culinaire',     'category_id' => 2, 'slug' => 'culinaire'],
        ]);
    }
}
