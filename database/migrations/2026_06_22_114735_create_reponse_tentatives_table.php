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

      

             $table->bigInteger('tentative_quiz_id')->nullable();
             $table->bigInteger('question_quiz_id')->nullable();
             $table->bigInteger('reponse_quiz_id')->nullable();


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
