<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
            'role'     => 'required|in:apprenant,formateur,admin',
        ]);

        // Identifiants statiques (à remplacer par une vraie base)
        $staticUsers = [
            'apprenant' => ['email' => 'apprenant@exemple.com', 'password' => 'password'],
            'formateur' => ['email' => 'formateur@exemple.com', 'password' => 'password'],
            'admin'     => ['email' => 'admin@exemple.com', 'password' => 'password'],
        ];

        $role = $request->input('role');
        $userData = $staticUsers[$role] ?? null;

        if (!$userData || $request->email !== $userData['email'] || $request->password !== $userData['password']) {
            return back()->withErrors(['email' => 'Identifiants incorrects pour le rôle sélectionné.']);
        }

        // Stockage en session
        Session::put('auth_user', [
            'id'    => 1,
            'name'  => ucfirst($role),
            'email' => $userData['email'],
            'role'  => $role,
        ]);

        // Redirection vers le dashboard du rôle
        $dashboardRoutes = [
            'apprenant' => 'apprenant.dashboard',
            'formateur' => 'formateur.dashboard',
            'admin'     => 'admin.dashboard',
        ];

        return redirect()->route($dashboardRoutes[$role]);
    }

    public function logout()
    {
        Session::forget('auth_user');
        return redirect()->route('login');
    }
}