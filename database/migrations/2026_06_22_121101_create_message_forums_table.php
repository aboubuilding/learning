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

             $table->bigInteger('forum_discussion_id')->nullable();
             $table->bigInteger('utilisateur_id')->nullable();
             $table->bigInteger('message_parent_id')->nullable();


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
