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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('categorie_formation_id')
        ->constrained('categories_formations');

    $table->foreignId('formateur_id')
        ->constrained('utilisateurs');

    $table->string('titre');

    $table->text('description');

    $table->integer('duree_minutes')->nullable();

    $table->enum('niveau', [
        'debutant',
        'intermediaire',
        'avance'
    ]);

    $table->string('image')->nullable();

    $table->boolean('est_publie')
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
        Schema::dropIfExists('formations');
    }
};
