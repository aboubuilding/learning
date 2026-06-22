<?php

namespace Database\Factories;

use App\Models\JournalActivite;
use App\Models\Utilisateur; // ou User selon ton modèle
use Illuminate\Database\Eloquent\Factories\Factory;

class JournalActiviteFactory extends Factory
{
    protected $model = JournalActivite::class;

    public function definition(): array
    {
        return [
            'utilisateur_id'         => Utilisateur::factory(), // ou User::factory()
            'action'                 => $this->faker->word(),
            'description'            => $this->faker->optional()->sentence(),
            'adresse_ip'             => $this->faker->optional()->ipv4(),
            'temps_passe_secondes'   => $this->faker->optional()->numberBetween(1, 3600),
            'etat'                   => 1,
        ];
    }
}