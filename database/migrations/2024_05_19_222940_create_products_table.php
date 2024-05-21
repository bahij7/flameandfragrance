<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('tags', ['New', 'Hot'])->nullable();
            $table->foreignId('pack_id')->constrained('packs')->onDelete('cascade');
            $table->decimal('oldPrice', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->json('colors')->nullable();
            $table->boolean('isPublished')->default(true);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
