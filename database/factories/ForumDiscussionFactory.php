<?php

namespace Database\Factories;

use App\Models\ForumDiscussion;
use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ForumDiscussionFactory extends Factory
{
    protected $model = ForumDiscussion::class;

    public function definition(): array
    {
        return [
            'formation_id'   => Formation::factory(),
            'titre'          => $this->faker->sentence(5),
            'description'    => $this->faker->optional()->paragraph(),
            'est_verrouille' => $this->faker->boolean(),
            'etat'           => 1,
        ];
    }
}