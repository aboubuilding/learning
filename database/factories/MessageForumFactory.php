<?php

namespace Database\Factories;

use App\Models\MessageForum;
use App\Models\ForumDiscussion;
use App\Models\Utilisateur; // ou User selon ton modèle
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageForumFactory extends Factory
{
    protected $model = MessageForum::class;

    public function definition(): array
    {
        return [
            'forum_discussion_id' => ForumDiscussion::factory(),
            'utilisateur_id'      => Utilisateur::factory(), // ou User::factory()
            'message_parent_id'   => null,
            'contenu'             => $this->faker->paragraph(),
            'est_modifie'         => $this->faker->boolean(),
            'date_modification'   => $this->faker->optional()->dateTimeBetween('-1 week', 'now'),
            'etat'                => 1,
        ];
    }
}