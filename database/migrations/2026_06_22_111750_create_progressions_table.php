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
        Schema::create('progressions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('utilisateur_id')
        ->constrained('utilisateurs');

    $table->foreignId('formation_id')
        ->constrained('formations');

    $table->decimal('taux_completion', 5, 2)
        ->default(0);

    $table->timestamp('date_completion')
        ->nullable();

        $table->tinyInteger('etat')->default(1)->comment('1: présent, 2: supprimé (soft delete)');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progressions');
    }
};
