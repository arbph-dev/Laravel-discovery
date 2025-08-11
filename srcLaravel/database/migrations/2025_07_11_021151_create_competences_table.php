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
        Schema::create('competences', function (Blueprint $table) {
			$table->id();
			$table->string('nom');
			$table->unsignedBigInteger('idp')->nullable(); // Parent
			$table->foreign('idp')->references('id')->on('competences')->onDelete('cascade');

			$table->string('code_rome')->nullable();
			$table->string('code_formacode')->nullable();
			$table->string('code_nsf')->nullable();
			$table->string('code_rncp')->nullable();
			
			$table->text('description')->nullable();
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competences');
    }
};
