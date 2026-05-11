<?php

namespace App\Http\Controllers;

use App\Models\Apprenant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApprenantController extends Controller
{
    // Affiche la liste complète des apprenants.
    public function index(): View
    {
        $apprenants = Apprenant::orderBy('id', 'desc')->get();

        return view('apprenants.index', compact('apprenants'));
    }

    // Affiche le formulaire de création.
    public function create(): View
    {
        return view('apprenants.create');
    }

    // Enregistre un nouvel apprenant après validation.
    public function add(Request $request): RedirectResponse
    {
        // Validation serveur obligatoire pour sécuriser les données entrantes.
        $validatedData = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:1'],
            'maladie' => ['required', 'string', 'max:255'],
        ]);

        Apprenant::create($validatedData);

        // Message flash stocké en session et affiché après redirection.
        return redirect()
            ->route('apprenants.index')
            ->with('success', 'Apprenant ajouté avec succès.');
    }

    // Affiche le détail d'un apprenant.
    public function getOne(int $id): View
    {
        $apprenant = Apprenant::find($id);

        // Si l'apprenant n'existe pas, Laravel renvoie une page 404.
        if (! $apprenant) {
            abort(404, 'Apprenant introuvable.');
        }

        return view('apprenants.show', compact('apprenant'));
    }

    // Affiche le formulaire de modification pré-rempli.
    public function updateForm(int $id): View
    {
        $apprenant = Apprenant::find($id);

        if (! $apprenant) {
            abort(404, 'Apprenant introuvable.');
        }

        return view('apprenants.edit', compact('apprenant'));
    }

    // Met à jour un apprenant existant après validation.
    public function update(Request $request, int $id): RedirectResponse
    {
        $apprenant = Apprenant::find($id);

        if (! $apprenant) {
            abort(404, 'Apprenant introuvable.');
        }

        $validatedData = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:1'],
            'maladie' => ['required', 'string', 'max:255'],
        ]);

        $apprenant->update($validatedData);

        return redirect()
            ->route('apprenants.index')
            ->with('success', 'Apprenant modifié avec succès.');
    }

    // Supprime un apprenant puis redirige vers la liste.
    public function delete(int $id): RedirectResponse
    {
        $apprenant = Apprenant::find($id);

        if (! $apprenant) {
            abort(404, 'Apprenant introuvable.');
        }

        $apprenant->delete();

        return redirect()
            ->route('apprenants.index')
            ->with('success', 'Apprenant supprimé avec succès.');
    }
}
