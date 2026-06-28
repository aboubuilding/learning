<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminModuleController extends Controller
{
    /**
     * Liste des modules.
     */
    public function index()
    {
        // Données fictives
        $modules = [
            [
                'id' => 1,
                'titre' => 'Introduction aux produits chimiques',
                'formation' => 'Sécurité chimique avancée',
                'formateur' => 'Sophie Martin',
                'ordre' => 1,
                'statut' => 'Actif',
            ],
            [
                'id' => 2,
                'titre' => 'Équipements de protection individuelle',
                'formation' => 'Sécurité chimique avancée',
                'formateur' => 'Thomas Moreau',
                'ordre' => 2,
                'statut' => 'Actif',
            ],
            [
                'id' => 3,
                'titre' => 'Procédures d\'urgence',
                'formation' => 'Sécurité chimique avancée',
                'formateur' => 'Sophie Martin',
                'ordre' => 3,
                'statut' => 'Inactif',
            ],
            [
                'id' => 4,
                'titre' => 'Introduction à REACH',
                'formation' => 'Introduction aux réglementations REACH',
                'formateur' => 'Jean Dupont',
                'ordre' => 1,
                'statut' => 'Actif',
            ],
        ];

        return view('admin.modules.index', compact('modules'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        // Simuler des formations
        $formations = [
            ['id' => 1, 'titre' => 'Sécurité chimique avancée'],
            ['id' => 2, 'titre' => 'Introduction aux réglementations REACH'],
            ['id' => 3, 'titre' => 'Gestion des coûts en entreprise'],
        ];

        // Simuler des formateurs
        $formateurs = [
            ['id' => 2, 'nom' => 'Sophie Martin', 'email' => 'sophie.martin@exemple.com'],
            ['id' => 5, 'nom' => 'Thomas Moreau', 'email' => 'thomas.moreau@exemple.com'],
            ['id' => 7, 'nom' => 'Isabelle Lefevre', 'email' => 'isabelle.lefevre@exemple.com'],
        ];

        return view('admin.modules.create', compact('formations', 'formateurs'));
    }

    /**
     * Simule la création d'un module.
     */
    public function store(Request $request)
    {
        return redirect()->route('admin.modules.index')->with('success', 'Module créé avec succès (simulation).');
    }

    /**
     * Formulaire d'édition.
     */
    public function edit($id)
    {
        // Simuler un module
        $module = [
            'id' => $id,
            'titre' => 'Introduction aux produits chimiques',
            'description' => 'Présentation des familles de produits chimiques et des risques associés.',
            'formation_id' => 1,
            'formateur_id' => 2,
            'ordre' => 1,
            'statut' => 'Actif',
        ];

        $formations = [
            ['id' => 1, 'titre' => 'Sécurité chimique avancée'],
            ['id' => 2, 'titre' => 'Introduction aux réglementations REACH'],
            ['id' => 3, 'titre' => 'Gestion des coûts en entreprise'],
        ];

        $formateurs = [
            ['id' => 2, 'nom' => 'Sophie Martin', 'email' => 'sophie.martin@exemple.com'],
            ['id' => 5, 'nom' => 'Thomas Moreau', 'email' => 'thomas.moreau@exemple.com'],
            ['id' => 7, 'nom' => 'Isabelle Lefevre', 'email' => 'isabelle.lefevre@exemple.com'],
        ];

        return view('admin.modules.edit', compact('module', 'formations', 'formateurs'));
    }

    /**
     * Simule la mise à jour d'un module.
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('admin.modules.index')->with('success', "Module #{$id} mis à jour (simulation).");
    }

    /**
     * Simule la suppression d'un module.
     */
    public function destroy($id)
    {
        return redirect()->route('admin.modules.index')->with('success', "Module #{$id} supprimé (simulation).");
    }

    /**
     * Détail d'un module.
     */
    public function show($id)
    {
        $module = [
            'id' => $id,
            'titre' => 'Introduction aux produits chimiques',
            'description' => 'Présentation des familles de produits chimiques et des risques associés.',
            'formation' => 'Sécurité chimique avancée',
            'formateur' => 'Sophie Martin',
            'ordre' => 1,
            'statut' => 'Actif',
            'ressources' => [
                ['titre' => 'Vidéo : Introduction', 'type' => 'Video'],
                ['titre' => 'Fiche technique : Familles chimiques', 'type' => 'PDF'],
                ['titre' => 'Quiz : Connaissances de base', 'type' => 'Quiz'],
            ],
        ];

        return view('admin.modules.show', compact('module'));
    }
}