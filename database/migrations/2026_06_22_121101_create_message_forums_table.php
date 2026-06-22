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
        Schema::create('message_forums', function (Blueprint $table) {
            $table->id();

            $table->foreignId('forum_discussion_id')
        ->constrained('forums_discussion')
        ->cascadeOnDelete();

    $table->foreignId('utilisateur_id')
        ->constrained('utilisateurs')
        ->cascadeOnDelete();

    $table->foreignId('message_parent_id')
        ->nullable()
        ->constrained('messages_forum')
        ->nullOnDelete();

    $table->text('contenu');

    $table->boolean('est_modifie')
        ->default(false);

    $table->timestamp('date_modification')
        ->nullable();

        
        
$table->tinyInteger('etat')->default(1)->comment('1: présent, 2: supprimé (soft delete)');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_forums');
    }
};
