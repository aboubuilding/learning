<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApprenantProgressionController extends Controller
{
    /**
     * Vue d'ensemble de la progression de l'apprenant.
     */
    public function index()
    {
        // Données de l'apprenant (simulées)
        $apprenant = [
            'nom' => 'Jean Dupont',
            'prenom' => 'Jean',
            'email' => 'jean.dupont@exemple.com',
            'photo' => null,
        ];

        // Statistiques globales
        $stats = [
            'total_formations' => 12,
            'terminees' => 5,
            'en_cours' => 4,
            'non_commencees' => 3,
            'taux_completion_global' => 68,
            'certificats_obtenus' => 4,
            'quiz_tentes' => 18,
            'quiz_reussis' => 14,
            'taux_reussite_quiz' => 78,
            'temps_total' => '24h 30min',
        ];

        // Formations suivies avec progression
        $formations = [
            [
                'id' => 1,
                'titre' => 'Sécurité chimique avancée',
                'categorie' => 'Sécurité',
                'formateur' => 'Sophie Martin',
                'progression' => 85,
                'statut' => 'en_cours', // en_cours, terminee, non_commencee
                'date_debut' => '2025-01-20',
                'date_fin' => null,
                'duree_totale' => '8h',
                'temps_passe' => '6h 45min',
                'modules' => 8,
                'modules_termines' => 7,
            ],
            [
                'id' => 2,
                'titre' => 'Introduction aux réglementations REACH',
                'categorie' => 'Réglementation',
                'formateur' => 'Jean Dupont',
                'progression' => 100,
                'statut' => 'terminee',
                'date_debut' => '2025-02-10',
                'date_fin' => '2025-03-15',
                'duree_totale' => '6h',
                'temps_passe' => '5h 50min',
                'modules' => 6,
                'modules_termines' => 6,
            ],
            [
                'id' => 3,
                'titre' => 'Gestion des coûts en entreprise',
                'categorie' => 'Recouvrement des coûts',
                'formateur' => 'Thomas Moreau',
                'progression' => 45,
                'statut' => 'en_cours',
                'date_debut' => '2025-03-01',
                'date_fin' => null,
                'duree_totale' => '5h',
                'temps_passe' => '2h 15min',
                'modules' => 5,
                'modules_termines' => 2,
            ],
            [
                'id' => 4,
                'titre' => 'Sécurité au travail : bases',
                'categorie' => 'Sécurité',
                'formateur' => 'Isabelle Lefevre',
                'progression' => 0,
                'statut' => 'non_commencee',
                'date_debut' => null,
                'date_fin' => null,
                'duree_totale' => '4h',
                'temps_passe' => '0h',
                'modules' => 4,
                'modules_termines' => 0,
            ],
            [
                'id' => 5,
                'titre' => 'Produits chimiques : stockage et transport',
                'categorie' => 'Produits chimiques',
                'formateur' => 'Sophie Martin',
                'progression' => 100,
                'statut' => 'terminee',
                'date_debut' => '2025-01-05',
                'date_fin' => '2025-02-20',
                'duree_totale' => '5h',
                'temps_passe' => '4h 50min',
                'modules' => 5,
                'modules_termines' => 5,
            ],
            [
                'id' => 6,
                'titre' => 'Réglementation environnementale',
                'categorie' => 'Réglementation',
                'formateur' => 'Jean Dupont',
                'progression' => 30,
                'statut' => 'en_cours',
                'date_debut' => '2025-03-20',
                'date_fin' => null,
                'duree_totale' => '6h',
                'temps_passe' => '1h 50min',
                'modules' => 6,
                'modules_termines' => 2,
            ],
        ];

        // Quiz récents
        $quiz_recents = [
            ['titre' => 'Quiz Sécurité Chimique', 'score' => 85, 'reussi' => true, 'date' => '2025-03-18'],
            ['titre' => 'Quiz REACH', 'score' => 60, 'reussi' => false, 'date' => '2025-03-10'],
            ['titre' => 'Quiz Stockage Produits', 'score' => 92, 'reussi' => true, 'date' => '2025-02-28'],
            ['titre' => 'Quiz Sécurité au travail', 'score' => 78, 'reussi' => true, 'date' => '2025-02-15'],
            ['titre' => 'Quiz Réglementation', 'score' => 45, 'reussi' => false, 'date' => '2025-02-01'],
        ];

        // Certificats obtenus
        $certificats = [
            ['titre' => 'Introduction aux réglementations REACH', 'date' => '2025-03-15', 'numero' => 'CERT-2025-001'],
            ['titre' => 'Produits chimiques : stockage et transport', 'date' => '2025-02-20', 'numero' => 'CERT-2025-002'],
            ['titre' => 'Sécurité chimique avancée', 'date' => '2025-04-01', 'numero' => 'CERT-2025-003'],
            ['titre' => 'Sécurité au travail : bases', 'date' => '2025-05-10', 'numero' => 'CERT-2025-004'],
        ];

        // Activités récentes (journal)
        $activites_recentes = [
            ['action' => 'Consultation du module 3', 'date' => '2025-03-25 10:30', 'formation' => 'Sécurité chimique avancée'],
            ['action' => 'Quiz terminé : Sécurité Chimique', 'date' => '2025-03-24 14:15', 'formation' => 'Sécurité chimique avancée'],
            ['action' => 'Téléchargement d\'un PDF', 'date' => '2025-03-23 09:45', 'formation' => 'Gestion des coûts'],
            ['action' => 'Connexion à la plateforme', 'date' => '2025-03-23 09:00', 'formation' => ''],
            ['action' => 'Début du module 2', 'date' => '2025-03-22 16:20', 'formation' => 'Réglementation environnementale'],
        ];

        // Données pour le graphique de progression (12 derniers mois)
        $progression_mensuelle = [
            'Avr 2024' => 15,
            'Mai 2024' => 22,
            'Juin 2024' => 28,
            'Juil 2024' => 35,
            'Aoû 2024' => 40,
            'Sep 2024' => 48,
            'Oct 2024' => 52,
            'Nov 2024' => 58,
            'Déc 2024' => 65,
            'Jan 2025' => 72,
            'Fév 2025' => 78,
            'Mar 2025' => 85,
        ];

        // Répartition par catégorie
        $categories_repartition = [
            'Sécurité' => 2,
            'Réglementation' => 2,
            'Recouvrement des coûts' => 1,
            'Produits chimiques' => 1,
        ];

        return view('apprenant.progression.index', compact(
            'apprenant',
            'stats',
            'formations',
            'quiz_recents',
            'certificats',
            'activites_recentes',
            'progression_mensuelle',
            'categories_repartition'
        ));
    }

    /**
     * Détail de la progression pour une formation spécifique.
     */
    public function show($id)
    {
        // Simuler une formation détaillée
        $formation = [
            'id' => $id,
            'titre' => 'Sécurité chimique avancée',
            'categorie' => 'Sécurité',
            'formateur' => 'Sophie Martin',
            'progression' => 85,
            'statut' => 'en_cours',
            'date_debut' => '2025-01-20',
            'date_fin' => null,
            'duree_totale' => '8h',
            'temps_passe' => '6h 45min',
            'modules' => [
                ['titre' => 'Introduction aux produits chimiques', 'termine' => true, 'duree' => '1h'],
                ['titre' => 'Équipements de protection individuelle', 'termine' => true, 'duree' => '1h 30min'],
                ['titre' => 'Procédures d\'urgence', 'termine' => true, 'duree' => '1h 15min'],
                ['titre' => 'Évaluation des risques', 'termine' => true, 'duree' => '1h'],
                ['titre' => 'Gestion des déchets chimiques', 'termine' => true, 'duree' => '1h'],
                ['titre' => 'Études de cas pratiques', 'termine' => false, 'duree' => '1h 15min'],
                ['titre' => 'Quiz final', 'termine' => false, 'duree' => '30min'],
                ['titre' => 'Certification', 'termine' => false, 'duree' => '30min'],
            ],
            'quiz' => [
                ['titre' => 'Quiz Sécurité Chimique 1', 'score' => 85, 'reussi' => true],
                ['titre' => 'Quiz Sécurité Chimique 2', 'score' => 70, 'reussi' => true],
            ],
        ];

        return view('apprenant.progression.show', compact('formation'));
    }
}