<?php

namespace Database\Factories;

use App\Models\ReponseQuizz;
use App\Models\QuestionQuizz; // ou QuestionQuiz
use Illuminate\Database\Eloquent\Factories\Factory;

class ReponseQuizzFactory extends Factory
{
    protected $model = ReponseQuizz::class;

    public function definition(): array
    {
        return [
            'question_quiz_id' => QuestionQuizz::factory(), // ou QuestionQuiz::factory()
            'reponse'          => $this->faker->sentence(6),
            'est_correcte'     => $this->faker->boolean(),
            'etat'             => 1,
        ];
    }
}