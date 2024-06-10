<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Méthode pour afficher le formulaire d'inscription
    public function register() {
        return view('authentifications.register');
    }
    
    // Méthode pour enregistrer un nouvel utilisateur
    public function registerSave(Request $request) {
        $request->validate([
            'nom' => 'required|string|max:30|min:2',
            'prenom' => 'required|string|max:50|min:3',
            'email' => 'required|email|unique:users|max:55',
            'password' => 'required|max:20|min:6'
        ]);

        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->role = "admin"; // Utilisateur créé en tant qu'administrateur
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login');
    }

    // Méthode pour afficher le formulaire de connexion
    public function login() {
        return view('authentifications.login');
    }

    // Méthode pour authentifier un utilisateur lors de la connexion
    public function loginSave(Request $request) {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/')->with('success', 'Connexion réussie.');
        }

        return back()->with('error', 'Vérifiez votre email ou mot de passe.');
    }

    // Méthode pour déconnecter l'utilisateur
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
