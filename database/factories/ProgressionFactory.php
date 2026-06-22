<?php

namespace Database\Factories;

use App\Models\Progression;
use App\Models\Utilisateur; // ou User selon ton modèle
use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgressionFactory extends Factory
{
    protected $model = Progression::class;

    public function definition(): array
    {
        return [
            'utilisateur_id'   => Utilisateur::factory(), // ou User::factory()
            'formation_id'     => Formation::factory(),
            'taux_completion'  => $this->faker->randomFloat(2, 0, 100),
            'date_completion'  => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'etat'             => 1,
        ];
    }
}