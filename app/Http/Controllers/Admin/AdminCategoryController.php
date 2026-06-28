<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Liste des catégories.
     */
    public function index()
    {
        $categories = [
            ['id' => 1, 'nom' => 'Produits chimiques', 'description' => 'Formations sur les produits chimiques', 'formations_count' => 5, 'etat' => 'Actif'],
            ['id' => 2, 'nom' => 'Réglementation', 'description' => 'Formations sur les normes et réglementations', 'formations_count' => 3, 'etat' => 'Actif'],
            ['id' => 3, 'nom' => 'Recouvrement des coûts', 'description' => 'Gestion des coûts et finance', 'formations_count' => 2, 'etat' => 'Actif'],
            ['id' => 4, 'nom' => 'Sécurité', 'description' => 'Sécurité au travail et prévention', 'formations_count' => 4, 'etat' => 'Actif'],
            ['id' => 5, 'nom' => 'Environnement', 'description' => 'Gestion environnementale', 'formations_count' => 1, 'etat' => 'Inactif'],
        ];

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Simule la création d'une catégorie.
     */
    public function store(Request $request)
    {
        return redirect()->route('admin.categories.index')->with('success', 'Catégorie créée avec succès (simulation).');
    }

    /**
     * Formulaire d'édition.
     */
    public function edit($id)
    {
        $category = [
            'id' => $id,
            'nom' => 'Sécurité',
            'description' => 'Sécurité au travail et prévention',
            'etat' => 'Actif',
        ];

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Simule la mise à jour d'une catégorie.
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('admin.categories.index')->with('success', "Catégorie #{$id} mise à jour (simulation).");
    }

    /**
     * Simule la suppression d'une catégorie.
     */
    public function destroy($id)
    {
        return redirect()->route('admin.categories.index')->with('success', "Catégorie #{$id} supprimée (simulation).");
    }

    /**
     * Détail d'une catégorie.
     */
    public function show($id)
    {
        $category = [
            'id' => $id,
            'nom' => 'Sécurité',
            'description' => 'Sécurité au travail et prévention. Formations sur les équipements de protection, les procédures d\'urgence et les normes de sécurité.',
            'etat' => 'Actif',
            'formations' => [
                ['id' => 1, 'titre' => 'Sécurité chimique avancée', 'niveau' => 'Avancé'],
                ['id' => 2, 'titre' => 'Sécurité au travail : bases', 'niveau' => 'Débutant'],
                ['id' => 3, 'titre' => 'Protection individuelle', 'niveau' => 'Intermédiaire'],
            ],
        ];

        return view('admin.categories.show', compact('category'));
    }
}