<?php

namespace Database\Factories;

use App\Models\ParticipantSession;
use App\Models\SessionFormation;
use App\Models\Utilisateur; // ou User selon ton modèle
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantSessionFactory extends Factory
{
    protected $model = ParticipantSession::class;

    public function definition(): array
    {
        return [
            'session_formation_id' => SessionFormation::factory(),
            'utilisateur_id'       => Utilisateur::factory(), // ou User::factory()
            'presence'             => $this->faker->boolean(),
            'date_inscription'     => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'etat'                 => 1,
        ];
    }
}