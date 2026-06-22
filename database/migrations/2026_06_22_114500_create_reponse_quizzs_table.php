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
        Schema::create('reponse_quizzs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('question_quiz_id')
        ->constrained('questions_quiz')
        ->cascadeOnDelete();

    $table->text('reponse');

    $table->boolean('est_correcte')
        ->default(false);

        $table->tinyInteger('etat')->default(1)->comment('1: présent, 2: supprimé (soft delete)');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reponse_quizzs');
    }
};
