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
        Schema::create('suivi_ressources', function (Blueprint $table) {
            $table->id();


            $table->bigInteger('utilisateur_id')->nullable();
            $table->bigInteger('ressource_pedagogique_id')->nullable();

    $table->boolean('consultee')
        ->default(false);

    $table->boolean('terminee')
        ->default(false);

    $table->integer('temps_passe_secondes')
        ->default(0);

    $table->timestamp('premiere_consultation')
        ->nullable();

    $table->timestamp('derniere_consultation')
        ->nullable();

    $table->timestamp('date_completion')
        ->nullable();


    $table->unique([
        'utilisateur_id',
        'ressource_pedagogique_id'
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
        Schema::dropIfExists('suivi_ressources');
    }
};
