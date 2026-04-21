<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->boolean('in_stock')->default(true);
            $table->float('rating')->default(0);
            $table->timestamps();

            $table->foreignId('category_id')->constrained()->cascadeOnDelete();

            $table->index('price');
            $table->index('rating');
            $table->index('created_at');
        });
        DB::statement(
            'ALTER TABLE products ADD CONSTRAINT products_rating_check CHECK (rating >= 0 AND rating <= 5)'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
