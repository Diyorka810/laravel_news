<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $it = Category::create([
            'name' => 'IT',
            'slug' => 'it',
            'parent_id' => null,
        ]);

        $it->children()->createMany([
            ['name' => 'Front-end', 'slug' => 'front'],
            ['name' => 'Back-end',  'slug' => 'back'],
        ]);

        $design = Category::create([
            'name' => 'Design',
            'slug' => 'design',
            'parent_id' => null,
        ]);

        $design->children()->createMany([
            ['name' => 'UI/UX',   'slug' => 'uiux'],
            ['name' => 'Graphic', 'slug' => 'graphic'],
        ]);

        $cars = Category::create([
            'name' => 'Cars',
            'slug' => 'cars',
            'parent_id' => null,
        ]);

        $cars->children()->createMany([
            ['name' => 'Italian',   'slug' => 'italian'],
            ['name' => 'German', 'slug' => 'german'],
            ['name' => 'Czech', 'slug' => 'сzech'],
        ]);
    }
}
