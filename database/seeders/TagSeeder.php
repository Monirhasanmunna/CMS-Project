<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::updateOrCreate([
            'name'  => 'Life Style',
            'slug'  => 'life style',
        ]);

        Tag::updateOrCreate([
            'name'  => 'Traveling',
            'slug'  => 'travelng',
        ]);

        Tag::updateOrCreate([
            'name'  => 'Sport',
            'slug'  => 'sport'
        ]);
    }
}
