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
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();
            $table->string('lbl');
            $table->string('adville');
            $table->string('addep', 5);
            $table->string('codeape', 10);
            $table->string('lblape');
            $table->string('urlweb')->nullable();
            $table->string('urlreg')->nullable();
            $table->string('pich')->nullable();
            $table->string('picl')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisations');
    }
};
