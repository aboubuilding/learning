<?php

namespace Database\Factories;

use App\Models\Quiz;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    protected $model = Quiz::class;

    public function definition(): array
    {
        return [
            'module_id'             => Module::factory(),
            'titre'                 => $this->faker->sentence(3),
            'score_minimal'         => $this->faker->numberBetween(50, 100),
            'nombre_max_tentatives' => $this->faker->numberBetween(1, 5),
            'etat'                  => 1,
        ];
    }
}