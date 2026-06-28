<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminParametreController extends Controller
{
    /**
     * Affiche le formulaire des paramètres.
     */
    public function index()
    {
        // Paramètres fictifs
        $parametres = [
            'nom_site' => 'AquaForm',
            'slogan' => 'Plateforme e-learning pour les métiers de l\'eau',
            'email_contact' => 'contact@aquaform.fr',
            'email_support' => 'support@aquaform.fr',
            'maintenance' => false,
            'inscriptions_ouvertes' => true,
            'nombre_tentatives_quiz' => 3,
            'seuil_reussite_default' => 70,
            'session_lifetime' => 120,
            'theme' => 'light',
            'langue' => 'fr',
        ];

        return view('admin.parametres.index', compact('parametres'));
    }

    /**
     * Met à jour les paramètres (simulation).
     */
    public function update(Request $request)
    {
        // Simulation : on redirige avec un message de succès
        return redirect()->route('admin.parametres.index')->with('success', 'Paramètres mis à jour avec succès (simulation).');
    }
}