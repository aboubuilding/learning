<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    /**
     * Liste des formations du formateur.
     */
    public function index()
    {
        $formations = [
            ['id' => 1, 'titre' => 'Sécurité chimique avancée', 'niveau' => 'Avancé', 'inscriptions' => 12, 'progression_moyenne' => 68],
            ['id' => 2, 'titre' => 'Introduction aux réglementations REACH', 'niveau' => 'Intermédiaire', 'inscriptions' => 8, 'progression_moyenne' => 55],
            ['id' => 3, 'titre' => 'Gestion des coûts en entreprise', 'niveau' => 'Intermédiaire', 'inscriptions' => 5, 'progression_moyenne' => 40],
        ];

        return view('formateur.formations.index', compact('formations'));
    }

    /**
     * Affiche le formulaire de création d'une formation.
     */
    public function create()
    {
        $categories = [
            ['id' => 1, 'nom' => 'Produits chimiques'],
            ['id' => 2, 'nom' => 'Réglementation'],
            ['id' => 3, 'nom' => 'Recouvrement des coûts'],
            ['id' => 4, 'nom' => 'Sécurité'],
        ];

        $niveaux = ['Débutant', 'Intermédiaire', 'Avancé'];

        return view('formateur.formations.create', compact('categories', 'niveaux'));
    }

    /**
     * Enregistre une nouvelle formation avec ses modules, ressources et quiz.
     */
    public function store(Request $request)
    {
        // Validation complète des données du formulaire
        $validated = $request->validate([
            // Informations générales
            'titre' => 'required|string|max:255',
            'categorie_id' => 'required|integer|min:1',
            'niveau' => 'required|in:Débutant,Intermédiaire,Avancé',
            'description' => 'nullable|string',
            'duree' => 'required|string',
            'est_publie' => 'boolean',

            // Modules
            'modules' => 'nullable|array',
            'modules.*.titre' => 'required_with:modules|string|max:255',
            'modules.*.ordre' => 'required_with:modules|integer|min:1',

            // Ressources (dans les modules)
            'modules.*.ressources' => 'nullable|array',
            'modules.*.ressources.*.titre' => 'required_with:modules.*.ressources|string|max:255',
            'modules.*.ressources.*.type' => 'required_with:modules.*.ressources|in:video,pdf,diaporama,guide,lien',
            'modules.*.ressources.*.url' => 'nullable|string|max:500',

            // Quiz de module
            'modules.*.has_quiz' => 'nullable|boolean',
            'modules.*.quiz.titre' => 'required_if:modules.*.has_quiz,1|string|max:255',
            'modules.*.quiz.score_minimal' => 'nullable|integer|min:0|max:100',
            'modules.*.quiz.nombre_tentatives' => 'nullable|integer|min:1',

            // Quiz globaux (indépendants)
            'quizzes' => 'nullable|array',
            'quizzes.*.titre' => 'required_with:quizzes|string|max:255',
            'quizzes.*.score_minimal' => 'nullable|integer|min:0|max:100',
            'quizzes.*.nombre_tentatives' => 'nullable|integer|min:1',
        ]);

        // --- Simulation de sauvegarde ---
        // Dans un vrai projet, vous enregistreriez :
        // 1. La formation (avec les champs de base)
        // 2. Pour chaque module, créez le module et associez-le à la formation
        // 3. Pour chaque ressource, créez la ressource et associez-la au module
        // 4. Pour chaque quiz (module ou global), créez le quiz et associez-le (au module ou à la formation)

        // On peut afficher les données reçues pour vérification (en dev)
        // dd($validated);

        // Redirection avec message de succès
        return redirect()->route('formateur.formations.index')
            ->with('success', 'Formation créée avec succès (simulation).');
    }

    /**
     * Affiche le détail d'une formation avec modules, ressources et inscrits.
     */
    public function show($id)
    {
        $formation = [
            'id' => $id,
            'titre' => 'Sécurité chimique avancée',
            'description' => 'Formation approfondie sur la manipulation des produits chimiques, les EPI et les procédures d\'urgence.',
            'categorie' => 'Sécurité',
            'niveau' => 'Avancé',
            'duree' => '8h',
            'statut' => 'Publiée',
            'formateur' => 'Sophie Martin',
            'date_creation' => '2025-01-15',
        ];

        $inscrits = [
            ['id' => 101, 'nom' => 'Jean Dupont', 'email' => 'jean.dupont@exemple.com', 'progression' => 75, 'date_inscription' => '2025-01-20'],
            ['id' => 102, 'nom' => 'Marie Curie', 'email' => 'marie.curie@exemple.com', 'progression' => 45, 'date_inscription' => '2025-02-01'],
            ['id' => 103, 'nom' => 'Pierre Bernard', 'email' => 'pierre.bernard@exemple.com', 'progression' => 90, 'date_inscription' => '2025-02-15'],
            ['id' => 104, 'nom' => 'Sophie Martin', 'email' => 'sophie.martin@exemple.com', 'progression' => 20, 'date_inscription' => '2025-03-01'],
        ];

        $modules = [
            [
                'id' => 1,
                'titre' => 'Introduction aux produits chimiques',
                'ordre' => 1,
                'ressources' => [
                    ['id' => 11, 'titre' => 'Vidéo d\'introduction', 'type' => 'video'],
                    ['id' => 12, 'titre' => 'PDF - Fiche sécurité', 'type' => 'pdf'],
                ]
            ],
            [
                'id' => 2,
                'titre' => 'Équipements de protection individuelle',
                'ordre' => 2,
                'ressources' => [
                    ['id' => 21, 'titre' => 'Vidéo EPI', 'type' => 'video'],
                    ['id' => 22, 'titre' => 'Guide interactif EPI', 'type' => 'guide'],
                    ['id' => 23, 'titre' => 'Diaporama EPI', 'type' => 'diaporama'],
                ]
            ],
            [
                'id' => 3,
                'titre' => 'Procédures d\'urgence',
                'ordre' => 3,
                'ressources' => [
                    ['id' => 31, 'titre' => 'Vidéo procédures', 'type' => 'video'],
                    ['id' => 32, 'titre' => 'PDF - Procédures', 'type' => 'pdf'],
                ]
            ],
        ];

        return view('formateur.formations.show', compact('formation', 'inscrits', 'modules'));
    }

    /**
     * Affiche le formulaire d'édition d'une formation.
     */
    public function edit($id)
    {
        $formation = [
            'id' => $id,
            'titre' => 'Sécurité chimique avancée',
            'description' => 'Formation approfondie sur la manipulation des produits chimiques, les EPI et les procédures d\'urgence.',
            'categorie_id' => 4,
            'niveau' => 'Avancé',
            'duree' => '8h',
            'est_publie' => true,
        ];

        $categories = [
            ['id' => 1, 'nom' => 'Produits chimiques'],
            ['id' => 2, 'nom' => 'Réglementation'],
            ['id' => 3, 'nom' => 'Recouvrement des coûts'],
            ['id' => 4, 'nom' => 'Sécurité'],
        ];

        $niveaux = ['Débutant', 'Intermédiaire', 'Avancé'];

        return view('formateur.formations.edit', compact('formation', 'categories', 'niveaux'));
    }

    /**
     * Met à jour une formation existante.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'niveau' => 'required|in:Débutant,Intermédiaire,Avancé',
            'description' => 'nullable|string',
            'duree' => 'required|string',
            'est_publie' => 'boolean',
        ]);

        return redirect()->route('formateur.formations.index')
            ->with('success', "Formation #{$id} mise à jour avec succès (simulation).");
    }

    /**
     * Supprime une formation.
     */
    public function destroy($id)
    {
        return redirect()->route('formateur.formations.index')
            ->with('success', "Formation #{$id} supprimée avec succès (simulation).");
    }

    // ============================================================
    // GESTION DES MODULES (intégrée dans la vue de détail)
    // ============================================================

    public function createModule($formationId)
    {
        $formation = [
            'id' => $formationId,
            'titre' => 'Sécurité chimique avancée',
        ];

        return view('formateur.modules.create', compact('formation'));
    }

    public function storeModule(Request $request, $formationId)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'ordre' => 'required|integer|min:1',
        ]);

        return redirect()->route('formateur.formations.show', $formationId)
            ->with('success', 'Module ajouté avec succès (simulation).');
    }

    public function editModule($formationId, $moduleId)
    {
        $module = [
            'id' => $moduleId,
            'titre' => 'Introduction aux produits chimiques',
            'ordre' => 1,
            'formation_id' => $formationId,
        ];

        return view('formateur.modules.edit', compact('module', 'formationId'));
    }

    public function updateModule(Request $request, $formationId, $moduleId)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'ordre' => 'required|integer|min:1',
        ]);

        return redirect()->route('formateur.formations.show', $formationId)
            ->with('success', "Module #{$moduleId} mis à jour (simulation).");
    }

    public function destroyModule($formationId, $moduleId)
    {
        return redirect()->route('formateur.formations.show', $formationId)
            ->with('success', "Module #{$moduleId} supprimé avec succès (simulation).");
    }
}