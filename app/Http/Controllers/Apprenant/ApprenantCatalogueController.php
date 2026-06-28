<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApprenantCatalogueController extends Controller
{
    /**
     * Affiche le catalogue des formations disponibles.
     */
    public function index()
    {
        // Données fictives des formations
        $formations = [
            [
                'id' => 1,
                'titre' => 'Sécurité chimique avancée',
                'categorie' => 'Sécurité',
                'description' => 'Formation approfondie sur la manipulation des produits chimiques. Couvre les normes de sécurité, les équipements de protection, et les procédures d\'urgence.',
                'niveau' => 'Avancé',
                'duree' => '8 heures',
                'formateur' => 'Sophie Martin',
                'image' => null,
                'est_inscrit' => true,
                'progression' => 85,
                'date_creation' => '2025-01-15',
                'rating' => 4.8,
                'avis' => 24,
            ],
            [
                'id' => 2,
                'titre' => 'Introduction aux réglementations REACH',
                'categorie' => 'Réglementation',
                'description' => 'Comprendre et appliquer les réglementations REACH pour la gestion des substances chimiques.',
                'niveau' => 'Intermédiaire',
                'duree' => '6 heures',
                'formateur' => 'Jean Dupont',
                'image' => null,
                'est_inscrit' => true,
                'progression' => 100,
                'date_creation' => '2025-02-10',
                'rating' => 4.5,
                'avis' => 18,
            ],
            [
                'id' => 3,
                'titre' => 'Gestion des coûts en entreprise',
                'categorie' => 'Recouvrement des coûts',
                'description' => 'Méthodes de recouvrement et optimisation budgétaire pour les services de l\'eau.',
                'niveau' => 'Intermédiaire',
                'duree' => '5 heures',
                'formateur' => 'Thomas Moreau',
                'image' => null,
                'est_inscrit' => false,
                'progression' => 0,
                'date_creation' => '2025-03-01',
                'rating' => 4.2,
                'avis' => 15,
            ],
            [
                'id' => 4,
                'titre' => 'Sécurité au travail : bases',
                'categorie' => 'Sécurité',
                'description' => 'Les fondamentaux de la sécurité en milieu professionnel, avec focus sur les EPI et les gestes de premiers secours.',
                'niveau' => 'Débutant',
                'duree' => '4 heures',
                'formateur' => 'Isabelle Lefevre',
                'image' => null,
                'est_inscrit' => false,
                'progression' => 0,
                'date_creation' => '2025-02-20',
                'rating' => 4.9,
                'avis' => 32,
            ],
            [
                'id' => 5,
                'titre' => 'Produits chimiques : stockage et transport',
                'categorie' => 'Produits chimiques',
                'description' => 'Bonnes pratiques pour le stockage et le transport sécurisé des produits chimiques.',
                'niveau' => 'Intermédiaire',
                'duree' => '5 heures',
                'formateur' => 'Sophie Martin',
                'image' => null,
                'est_inscrit' => true,
                'progression' => 100,
                'date_creation' => '2025-01-05',
                'rating' => 4.6,
                'avis' => 28,
            ],
            [
                'id' => 6,
                'titre' => 'Réglementation environnementale',
                'categorie' => 'Réglementation',
                'description' => 'Les réglementations environnementales applicables au secteur de l\'eau et de l\'assainissement.',
                'niveau' => 'Avancé',
                'duree' => '6 heures',
                'formateur' => 'Jean Dupont',
                'image' => null,
                'est_inscrit' => false,
                'progression' => 0,
                'date_creation' => '2025-03-20',
                'rating' => 4.3,
                'avis' => 12,
            ],
            [
                'id' => 7,
                'titre' => 'Recouvrement des coûts avancé',
                'categorie' => 'Recouvrement des coûts',
                'description' => 'Stratégies avancées pour optimiser le recouvrement des coûts dans les services publics de l\'eau.',
                'niveau' => 'Avancé',
                'duree' => '7 heures',
                'formateur' => 'Thomas Moreau',
                'image' => null,
                'est_inscrit' => false,
                'progression' => 0,
                'date_creation' => '2025-02-01',
                'rating' => 4.7,
                'avis' => 20,
            ],
            [
                'id' => 8,
                'titre' => 'Gestion des déchets chimiques',
                'categorie' => 'Produits chimiques',
                'description' => 'Procédures et réglementations pour la gestion des déchets chimiques en toute sécurité.',
                'niveau' => 'Intermédiaire',
                'duree' => '4 heures',
                'formateur' => 'Sophie Martin',
                'image' => null,
                'est_inscrit' => false,
                'progression' => 0,
                'date_creation' => '2025-03-10',
                'rating' => 4.4,
                'avis' => 16,
            ],
        ];

        // Liste des catégories pour les filtres
        $categories = ['Sécurité', 'Réglementation', 'Recouvrement des coûts', 'Produits chimiques'];
        $niveaux = ['Débutant', 'Intermédiaire', 'Avancé'];

        return view('apprenant.catalogue.index', compact('formations', 'categories', 'niveaux'));
    }

    /**
     * Affiche le détail d'une formation.
     */
    public function show($id)
    {
        // Simuler une formation en fonction de l'ID
        $formation = [
            'id' => $id,
            'titre' => 'Sécurité chimique avancée',
            'categorie' => 'Sécurité',
            'description' => 'Formation approfondie sur la manipulation des produits chimiques. Couvre les normes de sécurité, les équipements de protection, et les procédures d\'urgence.',
            'niveau' => 'Avancé',
            'duree' => '8 heures',
            'formateur' => 'Sophie Martin',
            'image' => null,
            'est_inscrit' => true,
            'progression' => 85,
            'date_creation' => '2025-01-15',
            'rating' => 4.8,
            'avis' => 24,
            'objectifs' => [
                'Maîtriser les normes de sécurité chimique',
                'Savoir utiliser les équipements de protection',
                'Connaître les procédures d\'urgence',
                'Évaluer les risques chimiques',
            ],
            'contenu' => [
                'Introduction aux produits chimiques',
                'Équipements de protection individuelle',
                'Procédures d\'urgence',
                'Évaluation des risques',
                'Gestion des déchets chimiques',
                'Études de cas pratiques',
                'Quiz final',
            ],
            'modules' => [
                ['titre' => 'Introduction aux produits chimiques', 'duree' => '1h', 'termine' => true],
                ['titre' => 'Équipements de protection individuelle', 'duree' => '1h30', 'termine' => true],
                ['titre' => 'Procédures d\'urgence', 'duree' => '1h15', 'termine' => true],
                ['titre' => 'Évaluation des risques', 'duree' => '1h', 'termine' => true],
                ['titre' => 'Gestion des déchets chimiques', 'duree' => '1h', 'termine' => false],
                ['titre' => 'Études de cas pratiques', 'duree' => '1h15', 'termine' => false],
                ['titre' => 'Quiz final', 'duree' => '30min', 'termine' => false],
            ],
            'quiz' => [
                ['titre' => 'Quiz Sécurité Chimique 1', 'score' => 85, 'reussi' => true],
                ['titre' => 'Quiz Sécurité Chimique 2', 'score' => 70, 'reussi' => true],
            ],
            'avis' => [
                ['user' => 'Jean Dupont', 'note' => 5, 'commentaire' => 'Excellent cours, très complet !', 'date' => '2025-02-01'],
                ['user' => 'Marie Curie', 'note' => 4, 'commentaire' => 'Très instructif, mais un peu dense.', 'date' => '2025-01-25'],
                ['user' => 'Pierre Dubois', 'note' => 5, 'commentaire' => 'Parfait pour les professionnels du secteur.', 'date' => '2025-01-20'],
            ],
        ];

        return view('apprenant.catalogue.show', compact('formation'));
    }
}