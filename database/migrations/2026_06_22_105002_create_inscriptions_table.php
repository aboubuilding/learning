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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();


            $table->bigInteger('utilisateur_id')->nullable();
            $table->bigInteger('formation_id')->nullable();

    $table->dateTime('date_inscription');

    $table->enum('statut', [
        'en_attente',
        'active',
        'terminee',
        'annulee'
    ])->default('active');


    $table->unique([
        'utilisateur_id',
        'formation_id'
    ]);


    $table->tinyInteger('etat')->default(1)->comment('1: présent, 2: supprimé (soft delete)');

    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
