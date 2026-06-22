<?php

namespace Database\Factories;

use App\Models\TentativeQuizz;
use App\Models\Utilisateur; // ou User
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class TentativeQuizzFactory extends Factory
{
    protected $model = TentativeQuizz::class;

    public function definition(): array
    {
        return [
            'utilisateur_id' => Utilisateur::factory(),
            'quiz_id'        => Quiz::factory(),
            'score'          => $this->faker->numberBetween(0, 100),
            'reussi'         => $this->faker->boolean(),
            'date_tentative' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'etat'           => 1,
        ];
    }
}