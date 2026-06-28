<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApprenantController extends Controller
{
    /**
     * Affiche le tableau de bord de l'apprenant (mes cours).
     */
    public function index()
    {
        // Données fictives de l'apprenant connecté
        $apprenant = [
            'nom' => 'Jean Dupont',
            'email' => 'jean.dupont@exemple.com',
        ];

        // Liste des formations suivies
        $mes_cours = [
            [
                'id' => 1,
                'titre' => 'Sécurité chimique avancée',
                'formateur' => 'Sophie Martin',
                'progression' => 75,
                'statut' => 'en_cours',
                'date_inscription' => '2025-01-15',
                'image' => null,
            ],
            [
                'id' => 2,
                'titre' => 'Introduction aux réglementations REACH',
                'formateur' => 'Jean Dupont',
                'progression' => 100,
                'statut' => 'termine',
                'date_inscription' => '2025-02-10',
                'image' => null,
            ],
            [
                'id' => 3,
                'titre' => 'Gestion des coûts en entreprise',
                'formateur' => 'Thomas Moreau',
                'progression' => 45,
                'statut' => 'en_cours',
                'date_inscription' => '2025-02-20',
                'image' => null,
            ],
            [
                'id' => 4,
                'titre' => 'Sécurité au travail : bases',
                'formateur' => 'Isabelle Lefevre',
                'progression' => 0,
                'statut' => 'a_faire',
                'date_inscription' => '2025-03-01',
                'image' => null,
            ],
        ];

        // Statistiques
        $stats = [
            'total' => count($mes_cours),
            'termines' => collect($mes_cours)->where('statut', 'termine')->count(),
            'en_cours' => collect($mes_cours)->where('statut', 'en_cours')->count(),
            'a_faire' => collect($mes_cours)->where('statut', 'a_faire')->count(),
            'progression_moyenne' => round(collect($mes_cours)->avg('progression')),
        ];

        return view('apprenant.mes-cours', compact('apprenant', 'mes_cours', 'stats'));
    }

    /**
     * Affiche le détail d'une formation suivie.
     */
    public function show($id)
    {
        // Simuler une formation avec ses modules
        $formation = [
            'id' => $id,
            'titre' => 'Sécurité chimique avancée',
            'description' => 'Formation approfondie sur la manipulation des produits chimiques.',
            'formateur' => 'Sophie Martin',
            'progression' => 75,
            'statut' => 'en_cours',
            'modules' => [
                ['id' => 1, 'titre' => 'Introduction aux produits chimiques', 'termine' => true],
                ['id' => 2, 'titre' => 'Équipements de protection individuelle', 'termine' => true],
                ['id' => 3, 'titre' => 'Procédures d\'urgence', 'termine' => false],
                ['id' => 4, 'titre' => 'Évaluation des risques', 'termine' => false],
            ],
        ];

        return view('apprenant.formation-detail', compact('formation'));
    }
}