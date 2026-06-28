<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminStatistiqueController extends Controller
{
    /**
     * Tableau de bord des statistiques globales.
     */
    public function index()
    {
        // Données globales
        $stats = [
            'total_utilisateurs' => 245,
            'total_formateurs' => 18,
            'total_apprenants' => 210,
            'total_formations' => 32,
            'total_inscriptions' => 412,
            'taux_completion_moyen' => 68.5,
            'certificats_delivres' => 189,
            'quiz_tentes' => 856,
            'quiz_reussis' => 632,
            'taux_reussite_quiz' => 73.8,
        ];

        // Évolution des inscriptions (12 derniers mois)
        $inscriptions_mensuelles = [
            'Jan' => 28,
            'Fév' => 35,
            'Mar' => 42,
            'Avr' => 30,
            'Mai' => 48,
            'Juin' => 55,
            'Juil' => 60,
            'Aoû' => 45,
            'Sep' => 52,
            'Oct' => 58,
            'Nov' => 65,
            'Déc' => 70,
        ];

        // Répartition par catégorie
        $categories = [
            'Produits chimiques' => 8,
            'Réglementation' => 6,
            'Recouvrement des coûts' => 5,
            'Sécurité' => 7,
            'Autres' => 6,
        ];

        // Top 5 formations les plus suivies
        $top_formations = [
            ['titre' => 'Sécurité chimique avancée', 'inscriptions' => 45],
            ['titre' => 'Introduction aux réglementations REACH', 'inscriptions' => 38],
            ['titre' => 'Gestion des coûts en entreprise', 'inscriptions' => 32],
            ['titre' => 'Sécurité au travail : bases', 'inscriptions' => 28],
            ['titre' => 'Produits chimiques : stockage et transport', 'inscriptions' => 25],
        ];

        // Répartition des utilisateurs par rôle
        $roles_repartition = [
            'Apprenants' => 210,
            'Formateurs' => 18,
            'Administrateurs' => 5,
        ];

        // Taux de complétion par formation (pour le graphique dédié)
        $completion_formations = [
            ['titre' => 'Sécurité chimique avancée', 'taux' => 82],
            ['titre' => 'Introduction aux réglementations REACH', 'taux' => 76],
            ['titre' => 'Gestion des coûts en entreprise', 'taux' => 68],
            ['titre' => 'Sécurité au travail : bases', 'taux' => 91],
            ['titre' => 'Produits chimiques : stockage et transport', 'taux' => 55],
            ['titre' => 'Réglementation environnementale', 'taux' => 63],
            ['titre' => 'Recouvrement des coûts avancé', 'taux' => 47],
        ];

        return view('admin.statistiques.index', compact(
            'stats',
            'inscriptions_mensuelles',
            'categories',
            'top_formations',
            'roles_repartition',
            'completion_formations'
        ));
    }

    /**
     * Page dédiée au taux de complétion détaillé.
     */
    public function completion()
    {
        // Données détaillées par formation
        $completion_data = [
            'formations' => [
                ['id' => 1, 'titre' => 'Sécurité chimique avancée', 'taux' => 82, 'inscrits' => 45, 'termines' => 37, 'en_cours' => 8],
                ['id' => 2, 'titre' => 'Introduction aux réglementations REACH', 'taux' => 76, 'inscrits' => 38, 'termines' => 29, 'en_cours' => 9],
                ['id' => 3, 'titre' => 'Gestion des coûts en entreprise', 'taux' => 68, 'inscrits' => 32, 'termines' => 22, 'en_cours' => 10],
                ['id' => 4, 'titre' => 'Sécurité au travail : bases', 'taux' => 91, 'inscrits' => 28, 'termines' => 25, 'en_cours' => 3],
                ['id' => 5, 'titre' => 'Produits chimiques : stockage et transport', 'taux' => 55, 'inscrits' => 25, 'termines' => 14, 'en_cours' => 11],
                ['id' => 6, 'titre' => 'Réglementation environnementale', 'taux' => 63, 'inscrits' => 20, 'termines' => 13, 'en_cours' => 7],
                ['id' => 7, 'titre' => 'Recouvrement des coûts avancé', 'taux' => 47, 'inscrits' => 15, 'termines' => 7, 'en_cours' => 8],
            ],
            'moyenne_globale' => 68.5,
            'taux_eleve' => 91,
            'taux_faible' => 47,
        ];

        return view('admin.statistiques.completion', $completion_data);
    }
}