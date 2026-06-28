<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Affiche le formulaire d'inscription.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Traite la demande d'inscription.
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Créer l'utilisateur
        $user = $this->create($request->all());

        // Vous pouvez ajouter ici une logique d'assignation de rôle, etc.

        return redirect()->route('login')
            ->with('success', 'Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.');
    }

    /**
     * Valide les données d'entrée.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom'      => ['required', 'string', 'max:255'],
            'prenom'   => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Crée un nouvel utilisateur dans la base de données.
     */
    protected function create(array $data)
    {
        return User::create([
            'nom'          => $data['nom'],
            'prenom'       => $data['prenom'],
            'email'        => $data['email'],
            'telephone'    => $data['telephone'] ?? null,
            'photo'        => null,
            'mot_de_passe' => Hash::make($data['password']),
            'etat'         => 1,
        ]);
    }


    /**
 * Affiche la page de confirmation après inscription.
 */
public function success()
{
    return view('auth.register-success');
}
}