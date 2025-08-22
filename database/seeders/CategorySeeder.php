<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vider la table categories (désactive temporairement la vérification des clés étrangères)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insertion des données
        Category::insert([
            ['name' => 'Essential Oil', 'slug' => 'essential-oil'],
            ['name' => 'Spices', 'slug' => 'spices'],
        ]);
    }
}
