<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function store(Request $request, $formationId)
    {
        // Simulation : on redirige avec succès
        return redirect()->route('formateur.formations.show', $formationId)
            ->with('success', 'Module ajouté avec succès.');
    }

    public function update(Request $request, $formationId, $moduleId)
    {
        return redirect()->route('formateur.formations.show', $formationId)
            ->with('success', 'Module mis à jour.');
    }

    public function destroy($formationId, $moduleId)
    {
        return redirect()->route('formateur.formations.show', $formationId)
            ->with('success', 'Module supprimé.');
    }
}

