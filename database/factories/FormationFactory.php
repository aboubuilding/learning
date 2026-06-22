<?php

namespace Database\Factories;

use App\Models\Formation;
use App\Models\CategorieFormation;
use App\Models\User; // ou Utilisateur selon ton modèle
use Illuminate\Database\Eloquent\Factories\Factory;

class FormationFactory extends Factory
{
    protected $model = Formation::class;

    public function definition(): array
    {
        return [
            'categorie_formation_id' => CategorieFormation::factory(),
            'formateur_id'           => User::factory(), // ou Utilisateur::factory()
            'titre'                  => $this->faker->sentence(3),
            'description'            => $this->faker->paragraph(),
            'duree_minutes'          => $this->faker->optional()->numberBetween(30, 600),
            'niveau'                 => $this->faker->randomElement(['debutant', 'intermediaire', 'avance']),
            'image'                  => $this->faker->optional()->imageUrl(),
            'est_publie'             => $this->faker->boolean(),
            'etat'                   => 1,
        ];
    }
}