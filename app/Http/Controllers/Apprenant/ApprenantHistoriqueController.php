<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApprenantHistoriqueController extends Controller
{
    /**
     * Affiche l'historique complet des formations suivies.
     */
    public function index()
    {
        // Données fictives de l'historique complet
        $historique = [
            [
                'id' => 1,
                'titre' => 'Sécurité chimique avancée',
                'categorie' => 'Sécurité',
                'formateur' => 'Sophie Martin',
                'date_debut' => '2025-01-20',
                'date_fin' => '2025-04-01',
                'progression' => 100,
                'statut' => 'terminee',
                'certificat' => 'CERT-2025-003',
                'temps_passe' => '7h 45min',
                'note' => 4.5,
                'evaluation' => 'Très bonne formation, contenu pratique.',
            ],
            [
                'id' => 2,
                'titre' => 'Introduction aux réglementations REACH',
                'categorie' => 'Réglementation',
                'formateur' => 'Jean Dupont',
                'date_debut' => '2025-02-10',
                'date_fin' => '2025-03-15',
                'progression' => 100,
                'statut' => 'terminee',
                'certificat' => 'CERT-2025-001',
                'temps_passe' => '5h 50min',
                'note' => 4.0,
                'evaluation' => 'Bien structuré, mais certains points techniques à approfondir.',
            ],
            [
                'id' => 3,
                'titre' => 'Gestion des coûts en entreprise',
                'categorie' => 'Recouvrement des coûts',
                'formateur' => 'Thomas Moreau',
                'date_debut' => '2025-03-01',
                'date_fin' => null,
                'progression' => 45,
                'statut' => 'en_cours',
                'certificat' => null,
                'temps_passe' => '2h 15min',
                'note' => null,
                'evaluation' => null,
            ],
            [
                'id' => 4,
                'titre' => 'Sécurité au travail : bases',
                'categorie' => 'Sécurité',
                'formateur' => 'Isabelle Lefevre',
                'date_debut' => null,
                'date_fin' => null,
                'progression' => 0,
                'statut' => 'non_commencee',
                'certificat' => null,
                'temps_passe' => '0h',
                'note' => null,
                'evaluation' => null,
            ],
            [
                'id' => 5,
                'titre' => 'Produits chimiques : stockage et transport',
                'categorie' => 'Produits chimiques',
                'formateur' => 'Sophie Martin',
                'date_debut' => '2025-01-05',
                'date_fin' => '2025-02-20',
                'progression' => 100,
                'statut' => 'terminee',
                'certificat' => 'CERT-2025-002',
                'temps_passe' => '4h 50min',
                'note' => 5.0,
                'evaluation' => 'Excellent contenu, cas pratiques très utiles.',
            ],
            [
                'id' => 6,
                'titre' => 'Réglementation environnementale',
                'categorie' => 'Réglementation',
                'formateur' => 'Jean Dupont',
                'date_debut' => '2025-03-20',
                'date_fin' => null,
                'progression' => 30,
                'statut' => 'en_cours',
                'certificat' => null,
                'temps_passe' => '1h 50min',
                'note' => null,
                'evaluation' => null,
            ],
            [
                'id' => 7,
                'titre' => 'Recouvrement des coûts avancé',
                'categorie' => 'Recouvrement des coûts',
                'formateur' => 'Thomas Moreau',
                'date_debut' => '2025-04-10',
                'date_fin' => null,
                'progression' => 10,
                'statut' => 'en_cours',
                'certificat' => null,
                'temps_passe' => '0h 30min',
                'note' => null,
                'evaluation' => null,
            ],
            [
                'id' => 8,
                'titre' => 'Manipulation des produits chimiques',
                'categorie' => 'Produits chimiques',
                'formateur' => 'Sophie Martin',
                'date_debut' => null,
                'date_fin' => null,
                'progression' => 0,
                'statut' => 'non_commencee',
                'certificat' => null,
                'temps_passe' => '0h',
                'note' => null,
                'evaluation' => null,
            ],
        ];

        // Statistiques pour le résumé
        $stats = [
            'total' => count($historique),
            'terminees' => collect($historique)->where('statut', 'terminee')->count(),
            'en_cours' => collect($historique)->where('statut', 'en_cours')->count(),
            'non_commencees' => collect($historique)->where('statut', 'non_commencee')->count(),
            'certificats' => collect($historique)->whereNotNull('certificat')->count(),
            'temps_total' => '22h 15min', // Simulé
        ];

        // Groupements pour filtres (déduits des données)
        $categories = collect($historique)->pluck('categorie')->unique()->values()->toArray();
        $statuts = ['terminee', 'en_cours', 'non_commencee'];

        return view('apprenant.historique.index', compact('historique', 'stats', 'categories', 'statuts'));
    }

    /**
     * Détail d'une formation dans l'historique.
     */
    public function show($id)
    {
        // Simuler une formation spécifique
        $formation = [
            'id' => $id,
            'titre' => 'Sécurité chimique avancée',
            'categorie' => 'Sécurité',
            'formateur' => 'Sophie Martin',
            'date_debut' => '2025-01-20',
            'date_fin' => '2025-04-01',
            'progression' => 100,
            'statut' => 'terminee',
            'certificat' => 'CERT-2025-003',
            'temps_passe' => '7h 45min',
            'note' => 4.5,
            'evaluation' => 'Très bonne formation, contenu pratique.',
            'modules' => [
                ['titre' => 'Introduction aux produits chimiques', 'termine' => true, 'duree' => '1h'],
                ['titre' => 'Équipements de protection individuelle', 'termine' => true, 'duree' => '1h 30min'],
                ['titre' => 'Procédures d\'urgence', 'termine' => true, 'duree' => '1h 15min'],
                ['titre' => 'Évaluation des risques', 'termine' => true, 'duree' => '1h'],
                ['titre' => 'Gestion des déchets chimiques', 'termine' => true, 'duree' => '1h'],
                ['titre' => 'Études de cas pratiques', 'termine' => true, 'duree' => '1h 15min'],
                ['titre' => 'Quiz final', 'termine' => true, 'duree' => '30min'],
                ['titre' => 'Certification', 'termine' => true, 'duree' => '30min'],
            ],
            'quiz' => [
                ['titre' => 'Quiz Sécurité Chimique 1', 'score' => 85, 'reussi' => true],
                ['titre' => 'Quiz Sécurité Chimique 2', 'score' => 70, 'reussi' => true],
            ],
        ];

        return view('apprenant.historique.show', compact('formation'));
    }
}