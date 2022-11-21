<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::updateOrCreate([
            'name'          => 'About Us',
            'slug'          => 'aboutus',
            'description'   => 'Et invidunt dolores erat gubergren sadipscing dolor voluptua invidunt vero kasd, sed sed tempor ipsum ut consetetur duo labore lorem sed. Sed et sanctus ut magna takimata duo accusam diam sea. Diam sea ipsum erat sit nonumy magna duo amet et, magna no erat labore dolore dolor amet aliquyam sadipscing.',
            'status'        => 1
        ]);

    }
}
