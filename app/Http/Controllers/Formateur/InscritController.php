<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InscritController extends Controller
{
    public function show($inscritId)
    {
        // Simuler les données d'un inscrit
        $inscrit = [
            'id' => $inscritId,
            'nom' => 'Jean Dupont',
            'email' => 'jean.dupont@exemple.com',
            'progression' => 75,
            'date_inscription' => '2025-01-20',
            'formations' => [
                ['titre' => 'Sécurité chimique avancée', 'progression' => 75, 'statut' => 'En cours'],
                ['titre' => 'Réglementation REACH', 'progression' => 100, 'statut' => 'Terminé'],
            ],
            'quiz' => [
                ['titre' => 'Quiz Sécurité', 'score' => 85, 'reussi' => true],
                ['titre' => 'Quiz REACH', 'score' => 60, 'reussi' => false],
            ],
            'certificats' => [
                ['titre' => 'Réglementation REACH', 'date' => '2025-02-20'],
            ],
        ];

        return view('formateur.inscrits.show', compact('inscrit'));
    }
}