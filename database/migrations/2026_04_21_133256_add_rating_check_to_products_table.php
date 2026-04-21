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
        DB::statement('ALTER TABLE products ADD CONSTRAINT products_rating_check CHECK (rating >= 0 AND rating <= 5)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE products DROP CHECK products_rating_check');
    }
};
