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
        Schema::create('participant_sessions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('session_formation_id')
        ->constrained('sessions_formation')
        ->cascadeOnDelete();

    $table->foreignId('utilisateur_id')
        ->constrained('utilisateurs')
        ->cascadeOnDelete();

    $table->boolean('presence')
        ->default(false);

    $table->datetime('date_inscription')
        ->nullable();

    $table->timestamps();

    $table->unique([
        'session_formation_id',
        'utilisateur_id'
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
        Schema::dropIfExists('participant_sessions');
    }
};
