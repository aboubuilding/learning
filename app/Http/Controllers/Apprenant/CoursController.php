<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CoursController extends Controller
{
    /**
     * Affiche la page de suivi d'un cours spécifique pour l'apprenant.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // ================================================================
        // 1. SIMULATION DES DONNÉES (À REMPLACER PAR VOTRE LOGIQUE MÉTIER)
        // ================================================================
        // Dans un projet réel, vous utiliseriez ici :
        // - $cours = Formation::with('modules.ressources')->findOrFail($id);
        // - Et vous calculeriez la progression réelle via les modèles (ex: SuiviRessource, Progression, etc.)
        // ================================================================

        $cours = [
            'id' => $id,
            'titre' => 'Sécurité chimique avancée',
            'description' => 'Formation complète sur la sécurité chimique, les équipements de protection individuelle (EPI) et les procédures d\'urgence en milieu industriel.',
            'formateur' => 'Sophie Martin',
            'progression' => 65, // Simulation du taux de complétion global
            'modules' => [
                [
                    'id' => 1,
                    'titre' => 'Introduction aux produits chimiques',
                    'termine' => true,
                    'duree' => '1h30',
                    'ordre' => 1,
                    'ressources' => [
                        ['id' => 1, 'titre' => 'Vidéo d\'introduction', 'type' => 'video', 'termine' => true],
                        ['id' => 2, 'titre' => 'PDF - Fiche sécurité', 'type' => 'pdf', 'termine' => true],
                    ]
                ],
                [
                    'id' => 2,
                    'titre' => 'Équipements de protection individuelle',
                    'termine' => true,
                    'duree' => '1h45',
                    'ordre' => 2,
                    'ressources' => [
                        ['id' => 3, 'titre' => 'Vidéo EPI', 'type' => 'video', 'termine' => true],
                        ['id' => 4, 'titre' => 'Guide interactif EPI', 'type' => 'guide', 'termine' => false],
                    ]
                ],
                [
                    'id' => 3,
                    'titre' => 'Procédures d\'urgence',
                    'termine' => false,
                    'duree' => '1h15',
                    'ordre' => 3,
                    'ressources' => [
                        ['id' => 5, 'titre' => 'Vidéo procédures', 'type' => 'video', 'termine' => false],
                        ['id' => 6, 'titre' => 'Diaporama - Procédures', 'type' => 'diaporama', 'termine' => false],
                    ]
                ],
                [
                    'id' => 4,
                    'titre' => 'Évaluation des risques',
                    'termine' => false,
                    'duree' => '1h30',
                    'ordre' => 4,
                    'ressources' => [
                        ['id' => 7, 'titre' => 'PDF - Méthode d\'évaluation', 'type' => 'pdf', 'termine' => false],
                    ]
                ],
            ],
            'quiz' => [
                ['id' => 1, 'titre' => 'Quiz Sécurité chimique', 'score' => 85, 'reussi' => true],
                ['id' => 2, 'titre' => 'Quiz EPI', 'score' => null, 'reussi' => null], // Non tenté
            ],
            'certificat' => false, // Non disponible tant que progression < 100
        ];

        // ================================================================
        // 2. TRAITEMENT DES DONNÉES (CORRIGE L'ERREUR groupBy)
        // ================================================================
        // On utilise collect() pour transformer le tableau en collection
        // et éviter l'erreur "Call to a member function groupBy() on array".
        $ressourcesParType = collect($cours['modules'])
            ->flatMap(fn($module) => $module['ressources'])
            ->groupBy('type');

        // Calculs des ressources totales et terminées
        $totalRessources = $ressourcesParType->flatten(1)->count();
        $ressourcesTerminees = $ressourcesParType
            ->flatten(1)
            ->filter(fn($r) => $r['termine'] === true)
            ->count();

        // ================================================================
        // 3. RETOUR DE LA VUE
        // ================================================================
        return view('apprenant.cours.show', compact(
            'cours',
            'ressourcesParType',
            'totalRessources',
            'ressourcesTerminees'
        ));
    }

    /**
     * (Optionnel) Marque une ressource comme terminée (ex: appel AJAX).
     * À implémenter selon votre besoin réel.
     */
    public function marquerRessourceTerminee(Request $request, $coursId, $ressourceId)
    {
        // Logique réelle : mettre à jour le suivi de la ressource pour l'utilisateur connecté
        // Exemple : SuiviRessource::updateOrCreate(...)

        return response()->json(['success' => true, 'message' => 'Ressource marquée comme terminée.']);
    }
}