<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement(
            "INSERT INTO post_translations
                (user_post_id, language, title, content, created_at, updated_at)
             SELECT id, 'ru', title, content, datetime('now'), datetime('now')
             FROM user_posts
             WHERE title IS NOT NULL"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('post_translations')
            ->where('language', 'ru')
            ->delete();
    }
};
