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
        Schema::create('certificats', function (Blueprint $table) {
            $table->id();

             $table->foreignId('utilisateur_id')
        ->constrained('utilisateurs');

    $table->foreignId('formation_id')
        ->constrained('formations');

    $table->string('numero_certificat')
        ->unique();

    $table->string('chemin_pdf');

    $table->timestamp('date_delivrance');

    $table->tinyInteger('etat')->default(1)->comment('1: présent, 2: supprimé (soft delete)');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificats');
    }
};
