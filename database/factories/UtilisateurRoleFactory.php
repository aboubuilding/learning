<?php

namespace Database\Factories;

use App\Models\UtilisateurRole;
use App\Models\Utilisateur; // ou User
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class UtilisateurRoleFactory extends Factory
{
    protected $model = UtilisateurRole::class;

    public function definition(): array
    {
        return [
            'utilisateur_id' => Utilisateur::factory(),
            'role_id'        => Role::factory(),
            'etat'           => 1,
        ];
    }
}