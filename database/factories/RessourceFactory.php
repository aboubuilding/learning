<?php

namespace Database\Factories;

use App\Models\Ressource;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class RessourceFactory extends Factory
{
    protected $model = Ressource::class;

    public function definition(): array
    {
        return [
            'module_id'      => Module::factory(),
            'titre'          => $this->faker->sentence(3),
            'type'           => $this->faker->randomElement(['video', 'pdf', 'diaporama', 'guide', 'lien']),
            'chemin_fichier' => $this->faker->optional()->filePath(),
            'url_externe'    => $this->faker->optional()->url(),
            'ordre'          => $this->faker->numberBetween(1, 10),
            'telechargeable' => $this->faker->boolean(),
            'etat'           => 1,
        ];
    }
}