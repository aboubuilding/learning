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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

                  $table->bigInteger('utilisateur_id')->nullable();

    $table->string('titre');

    $table->text('message');

    $table->boolean('lu')
        ->default(false);

    $table->timestamp('date_lecture')
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
        Schema::dropIfExists('notifications');
    }
};
