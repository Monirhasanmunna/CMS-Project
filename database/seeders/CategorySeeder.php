<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::updateOrCreate([
            'name'  => 'Business',
            'slug'  => 'business',
        ]);

        Category::updateOrCreate([
            'name'  => 'Technology',
            'slug'  => 'technology',
        ]);

        Category::updateOrCreate([
            'name'  => 'lifestyle',
            'slug'  => 'lifestyle',
        ]);
    }
}
