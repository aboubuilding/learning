<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs (statique).
     */
    public function index()
    {
        // Données fictives des utilisateurs
        $users = [
            [
                'id' => 1,
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'email' => 'jean.dupont@exemple.com',
                'role' => 'Apprenant',
                'statut' => 'Actif',
                'inscrit_le' => '2025-01-15',
            ],
            [
                'id' => 2,
                'nom' => 'Martin',
                'prenom' => 'Sophie',
                'email' => 'sophie.martin@exemple.com',
                'role' => 'Formateur',
                'statut' => 'Actif',
                'inscrit_le' => '2025-02-20',
            ],
            [
                'id' => 3,
                'nom' => 'Bernard',
                'prenom' => 'Pierre',
                'email' => 'pierre.bernard@exemple.com',
                'role' => 'Administrateur',
                'statut' => 'Actif',
                'inscrit_le' => '2024-12-01',
            ],
            [
                'id' => 4,
                'nom' => 'Lefevre',
                'prenom' => 'Claire',
                'email' => 'claire.lefevre@exemple.com',
                'role' => 'Apprenant',
                'statut' => 'Inactif',
                'inscrit_le' => '2025-03-10',
            ],
            [
                'id' => 5,
                'nom' => 'Moreau',
                'prenom' => 'Thomas',
                'email' => 'thomas.moreau@exemple.com',
                'role' => 'Formateur',
                'statut' => 'Actif',
                'inscrit_le' => '2025-01-25',
            ],
        ];

        return view('admin.users.index', compact('users'));
    }

    /**
     * Affiche le formulaire de création (statique).
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Affiche le formulaire d'édition (statique).
     */
    public function edit($id)
    {
        // Simuler un utilisateur fictif
        $user = [
            'id' => $id,
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'email' => 'jean.dupont@exemple.com',
            'role' => 'Apprenant',
            'statut' => 'Actif',
        ];

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Simule la suppression d'un utilisateur (redirection).
     */
    public function destroy($id)
    {
        // Redirection vers la liste avec un message flash statique
        return redirect()->route('admin.users.index')->with('success', "L'utilisateur #{$id} a été supprimé (simulation).");
    }

    /**
     * Simule la création d'un utilisateur (redirection).
     */
    public function store(Request $request)
    {
        // Redirection vers la liste avec un message flash
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès (simulation).');
    }

    /**
     * Simule la mise à jour d'un utilisateur (redirection).
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('admin.users.index')->with('success', "Utilisateur #{$id} mis à jour (simulation).");
    }

    public function show($id)
{
    // Simuler un utilisateur avec ses activités
    $user = [
        'id' => $id,
        'nom' => 'Dupont',
        'prenom' => 'Jean',
        'email' => 'jean.dupont@exemple.com',
        'telephone' => '06 12 34 56 78',
        'role' => 'Apprenant',
        'statut' => 'Actif',
        'inscrit_le' => '2025-01-15',
        'formations_suivies' => [
            ['titre' => 'Sécurité chimique', 'progression' => 75, 'date_inscription' => '2025-01-20'],
            ['titre' => 'Réglementation REACH', 'progression' => 100, 'date_inscription' => '2025-02-10'],
        ],
        'quiz_tentatives' => [
            ['titre' => 'Quiz Sécurité', 'score' => 80, 'reussi' => true, 'date' => '2025-01-25'],
            ['titre' => 'Quiz REACH', 'score' => 60, 'reussi' => false, 'date' => '2025-02-15'],
        ],
        'certificats' => [
            ['titre' => 'Réglementation REACH', 'date' => '2025-02-20'],
        ],
        'activites_recentes' => [
            ['action' => 'Connexion', 'date' => '2025-02-28 10:30'],
            ['action' => 'Consultation formation', 'date' => '2025-02-28 09:15'],
        ],
    ];

    return view('admin.users.show', compact('user'));
}
}