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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();

             $table->bigInteger('module_id')->nullable();

    $table->string('titre');

    $table->integer('score_minimal')
        ->default(70);

    $table->integer('nombre_max_tentatives')
        ->default(3);

        $table->tinyInteger('etat')->default(1)->comment('1: présent, 2: supprimé (soft delete)');

        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
