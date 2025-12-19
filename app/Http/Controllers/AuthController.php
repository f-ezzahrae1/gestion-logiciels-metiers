<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // login form afficher
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // traitement de la connexion
    public function login(Request $request)
    {
        // validation des données
        $credentials = $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required'
        ]);

        // tentative en utilisant vos propres champs
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['mot_de_passe']])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // si les données sont incorrectes
        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ]);
    }

    // traitement de la déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
