<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminInscriptionController extends Controller
{
    /**
     * Liste des inscriptions.
     */
    public function index()
    {
        // Données fictives d'inscriptions
        $inscriptions = [
            [
                'id' => 1,
                'apprenant' => 'Jean Dupont',
                'email' => 'jean.dupont@exemple.com',
                'formation' => 'Sécurité chimique avancée',
                'date_inscription' => '2025-01-15',
                'statut' => 'active',
                'progression' => 75,
            ],
            [
                'id' => 2,
                'apprenant' => 'Sophie Martin',
                'email' => 'sophie.martin@exemple.com',
                'formation' => 'Introduction aux réglementations REACH',
                'date_inscription' => '2025-02-10',
                'statut' => 'terminee',
                'progression' => 100,
            ],
            [
                'id' => 3,
                'apprenant' => 'Thomas Moreau',
                'email' => 'thomas.moreau@exemple.com',
                'formation' => 'Gestion des coûts en entreprise',
                'date_inscription' => '2025-02-20',
                'statut' => 'en_attente',
                'progression' => 0,
            ],
            [
                'id' => 4,
                'apprenant' => 'Isabelle Lefevre',
                'email' => 'isabelle.lefevre@exemple.com',
                'formation' => 'Sécurité chimique avancée',
                'date_inscription' => '2025-02-25',
                'statut' => 'annulee',
                'progression' => 0,
            ],
            [
                'id' => 5,
                'apprenant' => 'Pierre Bernard',
                'email' => 'pierre.bernard@exemple.com',
                'formation' => 'Réglementation REACH',
                'date_inscription' => '2025-03-01',
                'statut' => 'active',
                'progression' => 40,
            ],
        ];

        // Simuler des listes pour les filtres
        $formations = [
            'Sécurité chimique avancée',
            'Introduction aux réglementations REACH',
            'Gestion des coûts en entreprise',
            'Réglementation REACH',
        ];

        $apprenants = [
            'Jean Dupont',
            'Sophie Martin',
            'Thomas Moreau',
            'Isabelle Lefevre',
            'Pierre Bernard',
        ];

        return view('admin.inscriptions.index', compact('inscriptions', 'formations', 'apprenants'));
    }

    /**
     * Détail d'une inscription.
     */
    public function show($id)
    {
        // Simuler une inscription
        $inscription = [
            'id' => $id,
            'apprenant' => 'Jean Dupont',
            'email' => 'jean.dupont@exemple.com',
            'formation' => 'Sécurité chimique avancée',
            'date_inscription' => '2025-01-15',
            'statut' => 'active',
            'progression' => 75,
            'date_debut' => '2025-01-20',
            'date_fin_prevue' => '2025-03-20',
            'date_completion' => null,
            'modules' => [
                ['titre' => 'Introduction aux produits chimiques', 'termine' => true],
                ['titre' => 'Équipements de protection individuelle', 'termine' => true],
                ['titre' => 'Procédures d\'urgence', 'termine' => false],
                ['titre' => 'Évaluation des risques', 'termine' => false],
            ],
            'quiz' => [
                ['titre' => 'Quiz Sécurité 1', 'score' => 85, 'reussi' => true],
                ['titre' => 'Quiz Sécurité 2', 'score' => 60, 'reussi' => false],
            ],
        ];

        return view('admin.inscriptions.show', compact('inscription'));
    }

    /**
     * Formulaire d'édition du statut (ou modification).
     */
    public function edit($id)
    {
        // Simuler une inscription
        $inscription = [
            'id' => $id,
            'apprenant' => 'Jean Dupont',
            'formation' => 'Sécurité chimique avancée',
            'statut' => 'active',
        ];

        $statuts = ['en_attente', 'active', 'terminee', 'annulee'];

        return view('admin.inscriptions.edit', compact('inscription', 'statuts'));
    }

    /**
     * Met à jour le statut de l'inscription.
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('admin.inscriptions.index')->with('success', "Statut de l'inscription #{$id} mis à jour (simulation).");
    }

    /**
     * Supprime une inscription.
     */
    public function destroy($id)
    {
        return redirect()->route('admin.inscriptions.index')->with('success', "Inscription #{$id} supprimée (simulation).");
    }

    /**
     * Valider une inscription (passer de en_attente à active).
     */
    public function validateInscription($id)
    {
        return redirect()->route('admin.inscriptions.index')->with('success', "Inscription #{$id} validée (simulation).");
    }

    /**
     * Annuler une inscription.
     */
    public function cancelInscription($id)
    {
        return redirect()->route('admin.inscriptions.index')->with('success', "Inscription #{$id} annulée (simulation).");
    }
}