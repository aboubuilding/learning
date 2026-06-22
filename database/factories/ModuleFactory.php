<?php

namespace Database\Factories;

use App\Models\Module;
use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    protected $model = Module::class;

    public function definition(): array
    {
        return [
            'formation_id' => Formation::factory(),
            'titre'        => $this->faker->sentence(3),
            'description'  => $this->faker->optional()->paragraph(),
            'ordre'        => $this->faker->numberBetween(1, 20),
            'etat'         => 1,
        ];
    }
}