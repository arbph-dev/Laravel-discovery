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
        Schema::create('images', function (Blueprint $table) {
        $table->id();
        $table->string('path')->unique();      // ex: images/produits/logo.jpg
        $table->string('filename');            // ex: logo.jpg
        $table->integer('w')->nullable();      // largeur
        $table->integer('h')->nullable();      // hauteur
        $table->string('ext', 10);             // jpg, png, webp...
        $table->string('description')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
