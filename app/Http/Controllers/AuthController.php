<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login()
    {

        // User::create([
        //     'name' => 'John Doe',
        //     'email' => 'johndoe@example.com',
        //     'password' => Hash::make('1234'), // Hachage du mot de passe
        // ]);

        return view('auth.login');
    }

    public function toLogin(Request $request)
    {
        // Validation des champs requis
        $validated = $request->validate([
            "email" => "required|email", // Ajout de la validation pour un email valide
            "password" => "required", // Ajout d'une longueur minimale pour le mot de passe
        ]);

        // Tentative de connexion
        if (FacadesAuth::attempt($validated)) {
            // Régénération de la session pour éviter les attaques de fixation de session
            $request->session()->regenerate();

            // Ajout d'un message flash pour indiquer que l'utilisateur est connecté
            $request->session()->flash('success', 'Vous êtes bien connecté.');

            // Redirection vers la page prévue après connexion
            return redirect()->intended(route('etudiants.index'));
        } else {
            // Ajoutez un débogage ici pour vérifier les données
            logger('Tentative de connexion échouée', ['email' => $validated['email']]);
            // Redirection vers la page de connexion avec un message d'erreur
            return to_route("auth.login")
                ->withErrors(["email" => "Email ou mot de passe invalide"]) // Message d'erreur plus explicite
                ->onlyInput("email"); // Conserve l'email saisi
        }
    }

    public function logout(){
        FacadesAuth::logout();

        return to_route("auth.login");
    }
}
