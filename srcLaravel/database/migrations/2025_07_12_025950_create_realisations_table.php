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
        Schema::create('realisations', function (Blueprint $table) {
            $table->id();
			$table->foreignId('vaeexp_id')->constrained('vaeexps')->onDelete('cascade');
            $table->foreignId('organisation_id')->nullable()->constrained()->onDelete('set null');
            $table->string('titre');
            $table->text('description')->nullable();
            $table->text('resultat')->nullable();
            $table->text('conclusion')->nullable();
            $table->date('date_realisation')->nullable();
            $table->timestamps();
        });

        Schema::create('competence_realisation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competence_id')->constrained()->onDelete('cascade');
            $table->foreignId('realisation_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('image_realisation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id')->constrained()->onDelete('cascade');
            $table->foreignId('realisation_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_realisation');
        Schema::dropIfExists('competence_realisation');
        Schema::dropIfExists('realisations');
    }
};
