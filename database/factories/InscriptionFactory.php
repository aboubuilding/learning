<?php

namespace Database\Factories;

use App\Models\Inscription;
use App\Models\Utilisateur; // ou User selon ton modèle
use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

class InscriptionFactory extends Factory
{
    protected $model = Inscription::class;

    public function definition(): array
    {
        return [
            'utilisateur_id'   => Utilisateur::factory(), // ou User::factory()
            'formation_id'     => Formation::factory(),
            'date_inscription' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'statut'           => $this->faker->randomElement(['en_attente', 'active', 'terminee', 'annulee']),
            'etat'             => 1,
        ];
    }
}