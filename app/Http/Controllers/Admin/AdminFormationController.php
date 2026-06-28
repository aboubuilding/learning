<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminFormationController extends Controller
{
    /**
     * Liste des formations.
     */
    public function index()
    {
        $formations = [
            [
                'id' => 1,
                'titre' => 'Sécurité chimique avancée',
                'categorie' => 'Sécurité',
                'formateur' => 'Sophie Martin',
                'niveau' => 'Avancé',
                'duree' => 480,
                'inscriptions' => 12,
                'statut' => 'Publiée',
            ],
            [
                'id' => 2,
                'titre' => 'Introduction aux réglementations REACH',
                'categorie' => 'Réglementation',
                'formateur' => 'Jean Dupont',
                'niveau' => 'Intermédiaire',
                'duree' => 360,
                'inscriptions' => 8,
                'statut' => 'Publiée',
            ],
            [
                'id' => 3,
                'titre' => 'Gestion des coûts en entreprise',
                'categorie' => 'Recouvrement des coûts',
                'formateur' => 'Sophie Martin',
                'niveau' => 'Intermédiaire',
                'duree' => 300,
                'inscriptions' => 5,
                'statut' => 'Brouillon',
            ],
        ];

        return view('admin.formations.index', compact('formations'));
    }

    /**
     * Formulaire de création (statique).
     */
    public function create()
    {
        // Simuler des formateurs (utilisateurs avec rôle Formateur)
        $formateurs = [
            ['id' => 2, 'nom' => 'Sophie Martin', 'email' => 'sophie.martin@exemple.com'],
            ['id' => 5, 'nom' => 'Thomas Moreau', 'email' => 'thomas.moreau@exemple.com'],
            ['id' => 7, 'nom' => 'Isabelle Lefevre', 'email' => 'isabelle.lefevre@exemple.com'],
        ];

        // Simuler des catégories
        $categories = [
            ['id' => 1, 'nom' => 'Produits chimiques'],
            ['id' => 2, 'nom' => 'Réglementation'],
            ['id' => 3, 'nom' => 'Recouvrement des coûts'],
            ['id' => 4, 'nom' => 'Sécurité'],
        ];

        return view('admin.formations.create', compact('formateurs', 'categories'));
    }

    /**
     * Simule la création d'une formation.
     */
    public function store(Request $request)
    {
        return redirect()->route('admin.formations.index')->with('success', 'Formation créée avec succès (simulation).');
    }

    /**
     * Formulaire d'édition.
     */
    public function edit($id)
    {
        // Simuler une formation
        $formation = [
            'id' => $id,
            'titre' => 'Sécurité chimique avancée',
            'description' => 'Formation approfondie sur la manipulation des produits chimiques.',
            'categorie_id' => 4,
            'formateur_id' => 2,
            'niveau' => 'avance',
            'duree_minutes' => 480,
            'est_publie' => true,
        ];

        $formateurs = [
            ['id' => 2, 'nom' => 'Sophie Martin', 'email' => 'sophie.martin@exemple.com'],
            ['id' => 5, 'nom' => 'Thomas Moreau', 'email' => 'thomas.moreau@exemple.com'],
            ['id' => 7, 'nom' => 'Isabelle Lefevre', 'email' => 'isabelle.lefevre@exemple.com'],
        ];

        $categories = [
            ['id' => 1, 'nom' => 'Produits chimiques'],
            ['id' => 2, 'nom' => 'Réglementation'],
            ['id' => 3, 'nom' => 'Recouvrement des coûts'],
            ['id' => 4, 'nom' => 'Sécurité'],
        ];

        return view('admin.formations.edit', compact('formation', 'formateurs', 'categories'));
    }

    /**
     * Simule la mise à jour d'une formation.
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('admin.formations.index')->with('success', "Formation #{$id} mise à jour (simulation).");
    }

    /**
     * Simule la suppression d'une formation.
     */
    public function destroy($id)
    {
        return redirect()->route('admin.formations.index')->with('success', "Formation #{$id} supprimée (simulation).");
    }

    /**
     * Détail d'une formation.
     */
    public function show($id)
    {
        $formation = [
            'id' => $id,
            'titre' => 'Sécurité chimique avancée',
            'description' => 'Formation approfondie sur la manipulation des produits chimiques. Couvre les normes de sécurité, les équipements de protection, et les procédures d\'urgence.',
            'categorie' => 'Sécurité',
            'formateur' => 'Sophie Martin',
            'niveau' => 'Avancé',
            'duree' => '8h00',
            'est_publie' => true,
            'inscriptions' => 12,
            'modules' => [
                ['titre' => 'Introduction aux produits chimiques', 'ordre' => 1],
                ['titre' => 'Équipements de protection individuelle', 'ordre' => 2],
                ['titre' => 'Procédures d\'urgence', 'ordre' => 3],
                ['titre' => 'Évaluation des risques', 'ordre' => 4],
            ],
        ];

        return view('admin.formations.show', compact('formation'));
    }
}