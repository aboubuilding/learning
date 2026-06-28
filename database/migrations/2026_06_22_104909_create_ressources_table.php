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
        Schema::create('ressources', function (Blueprint $table) {
            $table->id();


               $table->bigInteger('module_id')->nullable();

    $table->string('titre');

    $table->enum('type', [
        'video',
        'pdf',
        'diaporama',
        'guide',
        'lien'
    ]);

    $table->string('chemin_fichier')
        ->nullable();

    $table->string('url_externe')
        ->nullable();

    $table->integer('ordre')
        ->default(1);

    $table->boolean('telechargeable')
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
        Schema::dropIfExists('ressources');
    }
};
