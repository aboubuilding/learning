<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApprenantCertificatController extends Controller
{
    /**
     * Liste des certificats de l'apprenant.
     */
    public function index()
    {
        // Simuler des certificats
        $certificats = [
            [
                'id' => 1,
                'titre' => 'Introduction aux réglementations REACH',
                'formation_id' => 2,
                'numero' => 'CERT-2025-001',
                'date_delivrance' => '2025-03-15',
                'chemin_pdf' => '#',
                'image' => null,
                'formateur' => 'Jean Dupont',
                'score' => 92,
            ],
            [
                'id' => 2,
                'titre' => 'Produits chimiques : stockage et transport',
                'formation_id' => 5,
                'numero' => 'CERT-2025-002',
                'date_delivrance' => '2025-02-20',
                'chemin_pdf' => '#',
                'image' => null,
                'formateur' => 'Sophie Martin',
                'score' => 88,
            ],
            [
                'id' => 3,
                'titre' => 'Sécurité chimique avancée',
                'formation_id' => 1,
                'numero' => 'CERT-2025-003',
                'date_delivrance' => '2025-04-01',
                'chemin_pdf' => '#',
                'image' => null,
                'formateur' => 'Sophie Martin',
                'score' => 85,
            ],
            [
                'id' => 4,
                'titre' => 'Sécurité au travail : bases',
                'formation_id' => 4,
                'numero' => 'CERT-2025-004',
                'date_delivrance' => '2025-05-10',
                'chemin_pdf' => '#',
                'image' => null,
                'formateur' => 'Isabelle Lefevre',
                'score' => 95,
            ],
        ];

        // Statistiques
        $stats = [
            'total' => count($certificats),
            'dernier' => $certificats[0] ?? null,
            'moyenne_score' => round(array_sum(array_column($certificats, 'score')) / max(1, count($certificats)), 1),
        ];

        return view('apprenant.certificats.index', compact('certificats', 'stats'));
    }

    /**
     * Détail d'un certificat.
     */
    public function show($id)
    {
        // Simuler un certificat
        $certificat = [
            'id' => $id,
            'titre' => 'Introduction aux réglementations REACH',
            'formation_id' => 2,
            'numero' => 'CERT-2025-001',
            'date_delivrance' => '2025-03-15',
            'chemin_pdf' => '#',
            'image' => null,
            'formateur' => 'Jean Dupont',
            'score' => 92,
            'apprenant' => 'Jean Dupont',
            'email' => 'jean.dupont@exemple.com',
            'duree_formation' => '6h',
            'date_completion' => '2025-03-14',
        ];

        return view('apprenant.certificats.show', compact('certificat'));
    }

    /**
     * Simule le téléchargement d'un certificat.
     */
    public function download($id)
    {
        // Rediriger avec un message de succès
        return redirect()->route('apprenant.certificats.index')
            ->with('success', 'Le certificat a été téléchargé avec succès (simulation).');
    }

    /**
     * Simule le partage d'un certificat par email.
     */
    public function share($id)
    {
        return redirect()->route('apprenant.certificats.index')
            ->with('success', 'Le certificat a été envoyé par email (simulation).');
    }
}