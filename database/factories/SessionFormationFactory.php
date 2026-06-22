<?php

namespace Database\Factories;

use App\Models\SessionFormation;
use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionFormationFactory extends Factory
{
    protected $model = SessionFormation::class;

    public function definition(): array
    {
        return [
            'formation_id'          => Formation::factory(),
            'titre'                 => $this->faker->sentence(4),
            'description'           => $this->faker->optional()->paragraph(),
            'date_session'          => $this->faker->dateTimeBetween('now', '+2 months'),
            'heure_debut'           => $this->faker->time('H:i:s'),
            'heure_fin'             => $this->faker->time('H:i:s'),
            'type_session'          => $this->faker->randomElement(['presentiel', 'visioconference', 'hybride']),
            'lieu'                  => $this->faker->optional()->city(),
            'lien_visioconference'  => $this->faker->optional()->url(),
            'nombre_places'         => $this->faker->optional()->numberBetween(5, 50),
            'est_active'            => $this->faker->boolean(),
            'etat'                  => 1,
        ];
    }
}