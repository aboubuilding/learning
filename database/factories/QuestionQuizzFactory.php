<?php

namespace Database\Factories;

use App\Models\QuestionQuizz;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionQuizzFactory extends Factory
{
    protected $model = QuestionQuizz::class;

    public function definition(): array
    {
        return [
            'quiz_id'    => Quiz::factory(),
            'question'   => $this->faker->sentence(10),
            'explication'=> $this->faker->optional()->paragraph(),
            'points'     => $this->faker->numberBetween(1, 5),
            'etat'       => 1,
        ];
    }
}