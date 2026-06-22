<?php

namespace Database\Factories;

use App\Models\Certificat;
use App\Models\Utilisateur; // ou User selon ton modèle
use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificatFactory extends Factory
{
    protected $model = Certificat::class;

    public function definition(): array
    {
        return [
            'utilisateur_id'    => Utilisateur::factory(), // ou User::factory()
            'formation_id'      => Formation::factory(),
            'numero_certificat' => $this->faker->unique()->bothify('CERT-####-????'),
            'chemin_pdf'        => $this->faker->filePath(),
            'date_delivrance'   => $this->faker->dateTimeBetween('-1 year', 'now'),
            'etat'              => 1,
        ];
    }
}