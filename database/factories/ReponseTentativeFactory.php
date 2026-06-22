<?php

namespace Database\Factories;

use App\Models\ReponseTentative;
use App\Models\TentativeQuizz;
use App\Models\QuestionQuizz;
use App\Models\ReponseQuizz;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReponseTentativeFactory extends Factory
{
    protected $model = ReponseTentative::class;

    public function definition(): array
    {
        return [
            'tentative_quiz_id' => TentativeQuizz::factory(),
            'question_quiz_id'  => QuestionQuizz::factory(),
            'reponse_quiz_id'   => ReponseQuizz::factory(),
            'etat'              => 1,
        ];
    }
}