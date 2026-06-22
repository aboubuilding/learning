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
        Schema::create('forum_discussions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('formation_id')
        ->constrained('formations')
        ->cascadeOnDelete();

    $table->string('titre');

    $table->text('description')
        ->nullable();

    $table->boolean('est_verrouille')
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
        Schema::dropIfExists('forum_discussions');
    }
};
