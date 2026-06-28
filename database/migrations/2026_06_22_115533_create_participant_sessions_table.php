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


               $table->bigInteger('session_formation_id')->nullable();
               $table->bigInteger('utilisateur_id')->nullable();

    $table->boolean('presence')
        ->default(false);

    $table->datetime('date_inscription')
        ->nullable();


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
