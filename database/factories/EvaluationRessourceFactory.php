<?php

namespace Database\Factories;

use App\Models\EvaluationRessource;
use App\Models\Formation;
use App\Models\Utilisateur; // ou User selon ton modèle
use Illuminate\Database\Eloquent\Factories\Factory;

class EvaluationRessourceFactory extends Factory
{
    protected $model = EvaluationRessource::class;

    public function definition(): array
    {
        return [
            'formation_id' => Formation::factory(),
            'utilisateur_id' => Utilisateur::factory(),
            'note' => $this->faker->numberBetween(1, 5),
            'commentaire' => $this->faker->optional()->paragraph(),
            'etat' => 1,
        ];
    }
}