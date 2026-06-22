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
        Schema::create('session_formations', function (Blueprint $table) {
            $table->id();

             $table->foreignId('formation_id')
        ->constrained('formations')
        ->cascadeOnDelete();

    $table->string('titre');

    $table->text('description')
        ->nullable();

    $table->date('date_session');

    $table->time('heure_debut');

    $table->time('heure_fin');

    $table->enum('type_session', [
        'presentiel',
        'visioconference',
        'hybride'
    ]);

    $table->string('lieu')
        ->nullable();

    $table->string('lien_visioconference')
        ->nullable();

    $table->integer('nombre_places')
        ->nullable();

    $table->boolean('est_active')
        ->default(true);


        $table->tinyInteger('etat')->default(1)->comment('1: présent, 2: supprimé (soft delete)');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_formations');
    }
};
