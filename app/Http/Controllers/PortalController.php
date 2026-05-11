<?php

namespace App\Http\Controllers;

use App\Models\Apprenant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortalController extends Controller
{
    // Affiche la page d'accueil.
    public function home(): View
    {
        return view('home');
    }

    // Affiche le formulaire d'authentification.
    public function showLogin(): View|RedirectResponse
    {
        if (session('is_authenticated')) {
            return redirect()->route('doctors.index');
        }

        return view('auth.login');
    }

    // Traite la connexion avec une validation simple pour le TP.
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:4'],
        ]);

        // Authentification pédagogique (identifiants statiques pour démonstration).
        $validEmail = 'admin@demo.com';
        $validPassword = 'admin1234';

        if ($credentials['email'] !== $validEmail || $credentials['password'] !== $validPassword) {
            return redirect()
                ->route('login.form')
                ->withInput()
                ->with('error', 'Identifiants invalides.');
        }

        // Stockage d'un indicateur de connexion dans la session.
        session([
            'is_authenticated' => true,
            'user_email' => $credentials['email'],
        ]);

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Connexion réussie.');
    }

    // Déconnecte l'utilisateur en nettoyant la session.
    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget(['is_authenticated', 'user_email']);

        return redirect()
            ->route('home')
            ->with('success', 'Déconnexion réussie.');
    }

    // Affiche la page des doctors (apprenants) avec recherche par nom.
    public function doctors(Request $request): View|RedirectResponse
    {
        if (! session('is_authenticated')) {
            return redirect()
                ->route('login.form')
                ->with('error', 'Veuillez vous connecter pour accéder aux doctors.');
        }

        $search = (string) $request->query('search', '');

        $patients = Apprenant::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('nom', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('doctors.index', [
            'patients' => $patients,
            'search' => $search,
        ]);
    }
}
