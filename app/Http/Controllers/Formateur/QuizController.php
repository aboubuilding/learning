<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Liste des quiz (avec filtre par formation).
     */
    public function index(Request $request)
    {
        // Simuler des formations (à remplacer par des données réelles)
        $formations = [
            ['id' => 1, 'titre' => 'Sécurité chimique avancée'],
            ['id' => 2, 'titre' => 'Introduction aux réglementations REACH'],
            ['id' => 3, 'titre' => 'Gestion des coûts en entreprise'],
        ];

        // Simuler des quiz
        $quizs = [
            ['id' => 1, 'titre' => 'Quiz Sécurité chimique', 'formation_id' => 1, 'module_id' => null, 'questions' => 5, 'tentatives' => 12, 'score_moyen' => 78],
            ['id' => 2, 'titre' => 'Quiz EPI', 'formation_id' => 1, 'module_id' => 2, 'questions' => 3, 'tentatives' => 8, 'score_moyen' => 65],
            ['id' => 3, 'titre' => 'Quiz REACH', 'formation_id' => 2, 'module_id' => null, 'questions' => 4, 'tentatives' => 6, 'score_moyen' => 82],
            ['id' => 4, 'titre' => 'Quiz Gestion des coûts', 'formation_id' => 3, 'module_id' => null, 'questions' => 6, 'tentatives' => 4, 'score_moyen' => 70],
        ];

        // Filtrer par formation
        if ($request->has('formation') && $request->formation != '') {
            $quizs = array_filter($quizs, fn($q) => $q['formation_id'] == $request->formation);
        }

        return view('formateur.quiz.index', compact('quizs', 'formations'));
    }

    /**
     * Formulaire de création d'un quiz.
     */
    public function create()
    {
        // Simuler des formations (à remplacer par une vraie requête)
        $formations = [
            ['id' => 1, 'titre' => 'Sécurité chimique avancée'],
            ['id' => 2, 'titre' => 'Introduction aux réglementations REACH'],
            ['id' => 3, 'titre' => 'Gestion des coûts en entreprise'],
        ];

        // Simuler des modules (par formation)
        $modules = [
            1 => [['id' => 1, 'titre' => 'Introduction'], ['id' => 2, 'titre' => 'EPI'], ['id' => 3, 'titre' => 'Urgence']],
            2 => [['id' => 4, 'titre' => 'REACH 1'], ['id' => 5, 'titre' => 'REACH 2']],
            3 => [['id' => 6, 'titre' => 'Coûts 1'], ['id' => 7, 'titre' => 'Coûts 2']],
        ];

        return view('formateur.quiz.create', compact('formations', 'modules'));
    }

    /**
     * Enregistre un nouveau quiz (simulation).
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'formation_id' => 'required|integer|min:1',
            'module_id' => 'nullable|integer|min:1',
            'score_minimal' => 'required|integer|min:0|max:100',
            'nombre_tentatives' => 'required|integer|min:1',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.points' => 'required|integer|min:1',
            'questions.*.reponses' => 'required|array|min:2',
            'questions.*.reponses.*.reponse' => 'required|string',
            'questions.*.reponses.*.est_correcte' => 'required|boolean',
        ]);

        // Simulation de sauvegarde
        return redirect()->route('formateur.quiz.index')
            ->with('success', 'Quiz créé avec succès (simulation).');
    }

    /**
     * Détail d'un quiz (visualisation).
     */
    public function show($id)
    {
        // Simuler un quiz
        $quiz = [
            'id' => $id,
            'titre' => 'Quiz Sécurité chimique',
            'formation' => 'Sécurité chimique avancée',
            'module' => 'Introduction',
            'score_minimal' => 70,
            'nombre_tentatives' => 3,
            'questions' => [
                [
                    'id' => 1,
                    'question' => 'Quelle est la formule chimique de l\'eau ?',
                    'points' => 2,
                    'reponses' => [
                        ['id' => 1, 'reponse' => 'H2O', 'est_correcte' => true],
                        ['id' => 2, 'reponse' => 'CO2', 'est_correcte' => false],
                        ['id' => 3, 'reponse' => 'NaCl', 'est_correcte' => false],
                    ]
                ],
                [
                    'id' => 2,
                    'question' => 'Quel est le symbole chimique du sodium ?',
                    'points' => 1,
                    'reponses' => [
                        ['id' => 4, 'reponse' => 'So', 'est_correcte' => false],
                        ['id' => 5, 'reponse' => 'Na', 'est_correcte' => true],
                        ['id' => 6, 'reponse' => 'S', 'est_correcte' => false],
                    ]
                ],
            ],
            'statistiques' => [
                'tentatives' => 12,
                'score_moyen' => 78,
                'reussite' => 75,
                'meilleur_score' => 100,
            ],
        ];

        return view('formateur.quiz.show', compact('quiz'));
    }

    /**
     * Formulaire d'édition d'un quiz.
     */
    public function edit($id)
{
    $quiz = [
        'id' => $id,
        'titre' => 'Quiz Sécurité chimique',
        'module_id' => 1,
        'score_minimal' => 70,
        'nombre_max_tentatives' => 3,
        'statut' => 'publié',
    ];

    $modules = [
        ['id' => 1, 'titre' => 'Module 1 - Introduction'],
        ['id' => 2, 'titre' => 'Module 2 - EPI'],
        ['id' => 3, 'titre' => 'Module 3 - Urgence'],
        ['id' => 4, 'titre' => 'Module 4 - Risques'],
    ];

    return view('formateur.quiz.edit', compact('quiz', 'modules'));
}

    /**
     * Met à jour un quiz (simulation).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'formation_id' => 'required|integer|min:1',
            'module_id' => 'nullable|integer|min:1',
            'score_minimal' => 'required|integer|min:0|max:100',
            'nombre_tentatives' => 'required|integer|min:1',
        ]);

        return redirect()->route('formateur.quiz.index')
            ->with('success', "Quiz #{$id} mis à jour avec succès (simulation).");
    }

    /**
     * Supprime un quiz (simulation).
     */
    public function destroy($id)
    {
        return redirect()->route('formateur.quiz.index')
            ->with('success', "Quiz #{$id} supprimé avec succès (simulation).");
    }

   

    /**
 * Affiche les résultats d'un quiz.
 */
public function results($id)
{
    // On passe l'ID à la vue
    return view('formateur.quiz.results', compact('id'));
}
}