<?php

namespace Database\Factories;

use App\Models\SuiviRessource;
use App\Models\Utilisateur;       // ou User selon ton modèle
use App\Models\RessourcePedagogique; // ou Ressource selon ton modèle (à adapter)
use Illuminate\Database\Eloquent\Factories\Factory;

class SuiviRessourceFactory extends Factory
{
    protected $model = SuiviRessource::class;

    public function definition(): array
    {
        return [
            'utilisateur_id'           => Utilisateur::factory(),
            'ressource_pedagogique_id' => RessourcePedagogique::factory(),
            'consultee'                => $this->faker->boolean(),
            'terminee'                 => $this->faker->boolean(),
            'temps_passe_secondes'     => $this->faker->numberBetween(0, 3600),
            'premiere_consultation'    => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'derniere_consultation'    => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'date_completion'          => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'etat'                     => 1,
        ];
    }
}