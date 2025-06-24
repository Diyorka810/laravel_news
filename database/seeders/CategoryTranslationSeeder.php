<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CategoryTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $translations = [
            ['category_id' => 1, 'locale' => 'en', 'name' => 'IT', 'slug' => 'it', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 1, 'locale' => 'ru', 'name' => 'ИТ', 'slug' => 'it', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 2, 'locale' => 'en', 'name' => 'Front-end', 'slug' => 'front', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 2, 'locale' => 'ru', 'name' => 'Фронт', 'slug' => 'front', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 3, 'locale' => 'en', 'name' => 'Back-end', 'slug' => 'back', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 3, 'locale' => 'ru', 'name' => 'Бэк', 'slug' => 'back', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 4, 'locale' => 'en', 'name' => 'Design', 'slug' => 'design', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 4, 'locale' => 'ru', 'name' => 'Дизайн', 'slug' => 'design', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 5, 'locale' => 'en', 'name' => 'UI/UX', 'slug' => 'uiux', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 6, 'locale' => 'en', 'name' => 'Graphic', 'slug' => 'graphic', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 6, 'locale' => 'ru', 'name' => 'Графика', 'slug' => 'graphic', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 7, 'locale' => 'en', 'name' => 'Cars', 'slug' => 'cars', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 7, 'locale' => 'ru', 'name' => 'Машины', 'slug' => 'cars', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 8, 'locale' => 'en', 'name' => 'Italian', 'slug' => 'italian', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 8, 'locale' => 'ru', 'name' => 'Итальянские', 'slug' => 'italian', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 9, 'locale' => 'en', 'name' => 'German', 'slug' => 'german', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 9, 'locale' => 'ru', 'name' => 'Немецкие', 'slug' => 'german', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 10, 'locale' => 'en', 'name' => 'Czech', 'slug' => 'czech', 'created_at' => $now, 'updated_at' => $now],
            ['category_id' => 10, 'locale' => 'ru', 'name' => 'Чешские', 'slug' => 'czech', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('category_translations')->insert($translations);
    }
}
