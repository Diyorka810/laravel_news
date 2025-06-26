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
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('ALTER TABLE posts DROP COLUMN IF EXISTS category_id CASCADE');
        } else {
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('ALTER TABLE posts ADD COLUMN category_id BIGINT');
            DB::statement('ALTER TABLE posts ADD CONSTRAINT posts_category_id_foreign
                           FOREIGN KEY (category_id) REFERENCES categories(id)
                           ON DELETE CASCADE');
        } else {
        }
    }
};
