<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\Utilisateur; // ou User selon ton modèle
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        return [
            'utilisateur_id' => Utilisateur::factory(), // ou User::factory()
            'titre'          => $this->faker->sentence(4),
            'message'        => $this->faker->paragraph(),
            'lu'             => $this->faker->boolean(),
            'date_lecture'   => $this->faker->optional()->dateTimeBetween('-1 week', 'now'),
            'etat'           => 1,
        ];
    }
}