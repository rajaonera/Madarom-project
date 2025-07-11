<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['id' => 1, 'name' => 'Huiles essentielles','slug' => 'huiles-essentielles'],
            ['id' => 2, 'name' => 'Épices', 'slug' => 'epices']
        ]);
    }
}
