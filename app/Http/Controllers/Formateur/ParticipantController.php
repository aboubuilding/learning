<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Liste des participants à toutes les formations du formateur.
     */
    public function index(Request $request)
    {
        // Simuler les formations du formateur
        $formations = [
            ['id' => 1, 'titre' => 'Sécurité chimique avancée'],
            ['id' => 2, 'titre' => 'Introduction aux réglementations REACH'],
            ['id' => 3, 'titre' => 'Gestion des coûts en entreprise'],
        ];

        // Simuler les participants (avec formation_id)
        $participants = [
            ['id' => 101, 'nom' => 'Jean Dupont', 'email' => 'jean.dupont@exemple.com', 'formation_id' => 1, 'progression' => 75, 'statut' => 'active', 'date_inscription' => '2025-01-20'],
            ['id' => 102, 'nom' => 'Marie Curie', 'email' => 'marie.curie@exemple.com', 'formation_id' => 1, 'progression' => 45, 'statut' => 'active', 'date_inscription' => '2025-02-01'],
            ['id' => 103, 'nom' => 'Pierre Bernard', 'email' => 'pierre.bernard@exemple.com', 'formation_id' => 2, 'progression' => 90, 'statut' => 'active', 'date_inscription' => '2025-02-15'],
            ['id' => 104, 'nom' => 'Sophie Martin', 'email' => 'sophie.martin@exemple.com', 'formation_id' => 1, 'progression' => 20, 'statut' => 'en_attente', 'date_inscription' => '2025-03-01'],
            ['id' => 105, 'nom' => 'Thomas Moreau', 'email' => 'thomas.moreau@exemple.com', 'formation_id' => 3, 'progression' => 0, 'statut' => 'annulee', 'date_inscription' => '2025-03-10'],
        ];

        // Filtrer par formation si demandé
        if ($request->has('formation') && $request->formation != '') {
            $participants = array_filter($participants, fn($p) => $p['formation_id'] == $request->formation);
        }

        return view('formateur.participants.index', compact('participants', 'formations'));
    }

    /**
     * Affiche le détail d'un participant.
     */
    public function show($id)
    {
        // Simuler le participant (à remplacer par une vraie requête)
        $participant = [
            'id' => $id,
            'nom' => 'Jean Dupont',
            'email' => 'jean.dupont@exemple.com',
            'formation' => 'Sécurité chimique avancée',
            'progression' => 75,
            'statut' => 'active',
            'date_inscription' => '2025-01-20',
            'modules' => [
                ['titre' => 'Introduction aux produits chimiques', 'termine' => true, 'score' => null],
                ['titre' => 'Équipements de protection individuelle', 'termine' => true, 'score' => null],
                ['titre' => 'Procédures d\'urgence', 'termine' => false, 'score' => null],
                ['titre' => 'Évaluation des risques', 'termine' => false, 'score' => null],
            ],
            'quiz' => [
                ['titre' => 'Quiz Sécurité chimique', 'score' => 85, 'reussi' => true],
                ['titre' => 'Quiz EPI', 'score' => null, 'reussi' => null],
            ],
            'certificat' => false,
            'temps_total' => '4h30',
        ];

        return view('formateur.participants.show', compact('participant'));
    }

    /**
     * Met à jour le statut d'un participant.
     */
    public function updateStatut(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,active,terminee,annulee',
        ]);

        // Simulation de mise à jour
        return redirect()->route('formateur.participants.index')
            ->with('success', "Statut du participant #{$id} mis à jour (simulation).");
    }

    /**
     * Désinscrit un participant (supprime l'inscription).
     */
    public function destroy($id)
    {
        // Simulation de suppression
        return redirect()->route('formateur.participants.index')
            ->with('success', "Participant #{$id} désinscrit avec succès (simulation).");
    }
}