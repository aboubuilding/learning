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
        Schema::create('reponse_tentatives', function (Blueprint $table) {
            $table->id();

             $table->foreignId('tentative_quiz_id')
        ->constrained('tentatives_quiz');

    $table->foreignId('question_quiz_id')
        ->constrained('questions_quiz');

    $table->foreignId('reponse_quiz_id')
        ->constrained('reponses_quiz');

        $table->tinyInteger('etat')->default(1)->comment('1: présent, 2: supprimé (soft delete)');

        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reponse_tentatives');
    }
};
