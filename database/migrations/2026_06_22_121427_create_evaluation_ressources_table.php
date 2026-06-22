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
        Schema::create('evaluation_ressources', function (Blueprint $table) {
            $table->id();
$table->foreignId('formation_id')
        ->constrained('formations')
        ->cascadeOnDelete();

    $table->foreignId('utilisateur_id')
        ->constrained('utilisateurs')
        ->cascadeOnDelete();

    $table->tinyInteger('note')
        ->comment('1 à 5');

    $table->text('commentaire')
        ->nullable();

        $table->tinyInteger('etat')->default(1)->comment('1: présent, 2: supprimé (soft delete)');

    $table->timestamps();

    $table->unique([
        'formation_id',
        'utilisateur_id'
    ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_ressources');
    }
};
