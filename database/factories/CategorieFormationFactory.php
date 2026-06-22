<?php

namespace Database\Factories;

use App\Models\CategorieFormation;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategorieFormationFactory extends Factory
{
    protected $model = CategorieFormation::class;

    public function definition(): array
    {
        return [
            'nom'         => $this->faker->unique()->word(),
            'description' => $this->faker->optional()->sentence(),
            'etat'        => 1,
        ];
    }
}