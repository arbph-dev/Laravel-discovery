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
        Schema::create('vaeexps', function (Blueprint $table) {
            $table->id();
            $table->date('dd');         // date de debut
            $table->date('df');         // date de fin
            $table->string('fonction'); // poste occupé techicien, agent de maitrise
            $table->tinytext('description'); // poste occupé techicien, agent de maitrise
            $table->timestamps();
            $table->foreignIdFor(App\Models\Organisation::class)->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaeexps');
    }
};
