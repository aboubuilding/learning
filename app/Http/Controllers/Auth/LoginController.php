<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Gère la tentative de connexion statique.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
            'role'     => 'required|in:apprenant,formateur,admin',
        ]);

        // ---- Identifiants statiques (en dur) ----
        $staticUsers = [
            'apprenant'  => [
                'email'    => 'apprenant@example.com',
                'password' => 'password',
            ],
            'formateur'  => [
                'email'    => 'formateur@example.com',
                'password' => 'password',
            ],
            'admin'      => [
                'email'    => 'admin@example.com',
                'password' => 'password',
            ],
        ];

        $role = $request->input('role');

        // Vérifier si les identifiants correspondent au rôle sélectionné
        $userData = $staticUsers[$role] ?? null;

        if (!$userData ||
            $request->email !== $userData['email'] ||
            $request->password !== $userData['password']) {

            return back()->withErrors([
                'email' => 'Identifiants incorrects pour le rôle sélectionné.',
            ])->withInput($request->only('email', 'role'));
        }

        // ---- Créer un utilisateur "virtuel" en session ----
        // On peut stocker en session les infos de l'utilisateur, ou utiliser un modèle User existant.
        // Ici, on va stocker un tableau simple.
        session([
            'auth_user' => [
                'id'    => 1,
                'name'  => ucfirst($role),
                'email' => $userData['email'],
                'role'  => $role,
            ]
        ]);

        // Rediriger vers le dashboard correspondant
        return redirect()->route($role . '.dashboard');
    }

    /**
     * Déconnexion (supprime la session).
     */
    public function logout()
    {
        Session::forget('auth_user');
        return redirect()->route('login');
    }
}