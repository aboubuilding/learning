<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RessourceController extends Controller
{
    public function store(Request $request, $moduleId)
    {
        // Simulation de sauvegarde
        return redirect()->back()->with('success', 'Ressource ajoutée (simulation).');
    }

    public function destroy($ressourceId)
    {
        // Simulation de suppression
        return redirect()->back()->with('success', 'Ressource supprimée (simulation).');
    }
}