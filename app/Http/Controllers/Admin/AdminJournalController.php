<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminJournalController extends Controller
{
    /**
     * Liste des activités journalisées.
     */
    public function index(Request $request)
    {
        // Simuler des données de journal
        $logs = [
            [
                'id' => 1,
                'utilisateur' => 'Jean Dupont',
                'email' => 'jean.dupont@exemple.com',
                'action' => 'connexion',
                'description' => 'L\'utilisateur s\'est connecté à la plateforme',
                'adresse_ip' => '192.168.1.10',
                'temps_passe' => null,
                'date' => '2025-02-28 10:30:15',
            ],
            [
                'id' => 2,
                'utilisateur' => 'Sophie Martin',
                'email' => 'sophie.martin@exemple.com',
                'action' => 'consultation_formation',
                'description' => 'Consultation de la formation : Sécurité chimique avancée',
                'adresse_ip' => '192.168.1.15',
                'temps_passe' => 120,
                'date' => '2025-02-28 09:15:42',
            ],
            [
                'id' => 3,
                'utilisateur' => 'Thomas Moreau',
                'email' => 'thomas.moreau@exemple.com',
                'action' => 'quiz_tente',
                'description' => 'Tentative de quiz : Quiz Sécurité chimique (score: 80%)',
                'adresse_ip' => '192.168.1.12',
                'temps_passe' => 45,
                'date' => '2025-02-28 08:50:10',
            ],
            [
                'id' => 4,
                'utilisateur' => 'Isabelle Lefevre',
                'email' => 'isabelle.lefevre@exemple.com',
                'action' => 'telechargement',
                'description' => 'Téléchargement du document : Fiche technique - Sécurité EPI',
                'adresse_ip' => '192.168.1.18',
                'temps_passe' => null,
                'date' => '2025-02-27 17:20:33',
            ],
            [
                'id' => 5,
                'utilisateur' => 'Pierre Bernard',
                'email' => 'pierre.bernard@exemple.com',
                'action' => 'inscription_cours',
                'description' => 'Inscription à la formation : Introduction aux réglementations REACH',
                'adresse_ip' => '192.168.1.20',
                'temps_passe' => null,
                'date' => '2025-02-27 14:05:22',
            ],
            [
                'id' => 6,
                'utilisateur' => 'Jean Dupont',
                'email' => 'jean.dupont@exemple.com',
                'action' => 'deconnexion',
                'description' => 'L\'utilisateur s\'est déconnecté',
                'adresse_ip' => '192.168.1.10',
                'temps_passe' => null,
                'date' => '2025-02-27 12:45:00',
            ],
            [
                'id' => 7,
                'utilisateur' => 'Sophie Martin',
                'email' => 'sophie.martin@exemple.com',
                'action' => 'modification_cours',
                'description' => 'Modification de la formation : Gestion des coûts en entreprise',
                'adresse_ip' => '192.168.1.15',
                'temps_passe' => 60,
                'date' => '2025-02-27 11:30:18',
            ],
            [
                'id' => 8,
                'utilisateur' => 'Thomas Moreau',
                'email' => 'thomas.moreau@exemple.com',
                'action' => 'connexion',
                'description' => 'L\'utilisateur s\'est connecté à la plateforme',
                'adresse_ip' => '192.168.1.12',
                'temps_passe' => null,
                'date' => '2025-02-27 09:00:05',
            ],
            [
                'id' => 9,
                'utilisateur' => 'Admin Principal',
                'email' => 'admin@aquaform.fr',
                'action' => 'ajout_utilisateur',
                'description' => 'Ajout d\'un nouvel utilisateur : Claire Lefevre',
                'adresse_ip' => '192.168.1.5',
                'temps_passe' => null,
                'date' => '2025-02-26 16:40:55',
            ],
            [
                'id' => 10,
                'utilisateur' => 'Jean Dupont',
                'email' => 'jean.dupont@exemple.com',
                'action' => 'progression',
                'description' => 'Progression de la formation : Sécurité chimique avancée - 75%',
                'adresse_ip' => '192.168.1.10',
                'temps_passe' => 30,
                'date' => '2025-02-26 14:20:30',
            ],
        ];

        // Simuler des listes pour les filtres
        $utilisateurs = [
            'Jean Dupont',
            'Sophie Martin',
            'Thomas Moreau',
            'Isabelle Lefevre',
            'Pierre Bernard',
            'Admin Principal',
        ];

        $actions = [
            'connexion',
            'deconnexion',
            'consultation_formation',
            'quiz_tente',
            'telechargement',
            'inscription_cours',
            'modification_cours',
            'ajout_utilisateur',
            'progression',
        ];

        // Filtrage simulé (si des paramètres GET sont passés)
        $query = $request->get('q');
        $utilisateur = $request->get('utilisateur');
        $action = $request->get('action');
        $date_debut = $request->get('date_debut');
        $date_fin = $request->get('date_fin');

        // Filtrer les logs (simulation)
        $filteredLogs = $logs;
        if ($query) {
            $filteredLogs = array_filter($filteredLogs, function($log) use ($query) {
                return stripos($log['utilisateur'], $query) !== false ||
                       stripos($log['email'], $query) !== false ||
                       stripos($log['description'], $query) !== false;
            });
        }
        if ($utilisateur) {
            $filteredLogs = array_filter($filteredLogs, function($log) use ($utilisateur) {
                return $log['utilisateur'] === $utilisateur;
            });
        }
        if ($action) {
            $filteredLogs = array_filter($filteredLogs, function($log) use ($action) {
                return $log['action'] === $action;
            });
        }
        if ($date_debut) {
            $filteredLogs = array_filter($filteredLogs, function($log) use ($date_debut) {
                return $log['date'] >= $date_debut;
            });
        }
        if ($date_fin) {
            $filteredLogs = array_filter($filteredLogs, function($log) use ($date_fin) {
                return $log['date'] <= $date_fin . ' 23:59:59';
            });
        }

        // Réindexer
        $filteredLogs = array_values($filteredLogs);

        // Pagination simulée (10 par page)
        $perPage = 10;
        $page = $request->get('page', 1);
        $total = count($filteredLogs);
        $totalPages = ceil($total / $perPage);
        $offset = ($page - 1) * $perPage;
        $pagedLogs = array_slice($filteredLogs, $offset, $perPage);

        return view('admin.journal.index', compact(
            'pagedLogs',
            'total',
            'perPage',
            'page',
            'totalPages',
            'utilisateurs',
            'actions',
            'query',
            'utilisateur',
            'action',
            'date_debut',
            'date_fin'
        ));
    }

    /**
     * Export du journal en CSV (simulation).
     */
    public function export(Request $request)
    {
        // Redirection avec message de succès
        return redirect()->route('admin.journal.index')->with('success', 'Export du journal en cours (simulation).');
    }
}