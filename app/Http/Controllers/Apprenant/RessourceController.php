<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RessourceController extends Controller
{
    /**
     * Affiche la page de lecture d'une ressource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Simuler une ressource avec ses données
        $ressource = $this->getRessourceSimulee($id);
        $cours = $this->getCoursSimule($ressource['cours_id']);

        return view('apprenant.ressource.show', compact('ressource', 'cours'));
    }

    /**
     * Marque une ressource comme terminée (AJAX ou redirection).
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function markCompleted(Request $request, $id)
    {
        // Simuler la mise à jour du suivi de la ressource
        // Dans la réalité : SuiviRessource::updateOrCreate(...)

        // Simuler la mise à jour de la progression du cours
        // Ici on retourne une réponse JSON (pour AJAX) ou une redirection

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Ressource marquée comme terminée.',
                'progression' => 70 // Nouveau taux de progression simulé
            ]);
        }

        return redirect()->back()->with('success', 'Ressource marquée comme terminée.');
    }

    /**
     * Télécharge un PDF (simulation).
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id)
    {
        // Dans un projet réel, le fichier serait stocké dans storage
        // Simuler un téléchargement avec un fichier factice
        $ressource = $this->getRessourceSimulee($id);

        if ($ressource['type'] !== 'pdf') {
            abort(404, 'Cette ressource n\'est pas un PDF.');
        }

        // Simuler un fichier PDF (on va créer un fichier temporaire)
        $content = 'Contenu PDF fictif pour ' . $ressource['titre'];
        $filename = 'ressource_' . $id . '.pdf';
        $path = storage_path('app/temp/' . $filename);
        // S'assurer que le dossier temp existe
        if (!is_dir(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }
        file_put_contents($path, $content);

        return response()->download($path, $filename)->deleteFileAfterSend(true);
    }

    // ---- Données simulées (à remplacer par votre logique métier) ----

    protected function getRessourceSimulee($id)
    {
        $ressources = [
            1 => [
                'id' => 1,
                'titre' => 'Vidéo d\'introduction à la sécurité chimique',
                'type' => 'video', // video, pdf, diaporama, guide, lien
                'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', // lien externe (ex: Vimeo, YouTube)
                'fichier' => null, // pour les PDF, chemin local
                'cours_id' => 1,
                'termine' => false,
                'description' => 'Cette vidéo présente les bases de la sécurité chimique en milieu professionnel.',
            ],
            2 => [
                'id' => 2,
                'titre' => 'Fiche sécurité - Produits chimiques',
                'type' => 'pdf',
                'url' => null,
                'fichier' => 'securite.pdf',
                'cours_id' => 1,
                'termine' => false,
                'description' => 'Document PDF résumant les règles de sécurité pour les produits chimiques.',
            ],
            // Ajout de la ressource 6 pour tester votre URL
            6 => [
                'id' => 6,
                'titre' => 'Diaporama - Procédures d\'urgence',
                'type' => 'diaporama',
                'url' => '#',
                'fichier' => null,
                'cours_id' => 1,
                'termine' => false,
                'description' => 'Diaporama interactif sur les procédures d\'urgence.',
            ],
        ];

        return $ressources[$id] ?? abort(404, 'Ressource non trouvée');
    }

    protected function getCoursSimule($coursId)
    {
        $cours = [
            1 => [
                'id' => 1,
                'titre' => 'Sécurité chimique avancée',
                'progression' => 65,
                'taux_completion' => 65,
                'modules' => [
                    ['id' => 1, 'titre' => 'Introduction', 'ordre' => 1],
                    ['id' => 2, 'titre' => 'EPI', 'ordre' => 2],
                    ['id' => 3, 'titre' => 'Urgence', 'ordre' => 3],
                    ['id' => 4, 'titre' => 'Risques', 'ordre' => 4],
                ],
            ],
        ];

        return $cours[$coursId] ?? abort(404, 'Cours non trouvé');
    }
}