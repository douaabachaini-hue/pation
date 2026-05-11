<?php

// Importation du contrôleur principal de gestion des apprenants.
use App\Http\Controllers\ApprenantController;
use App\Http\Controllers\PortalController;
use App\Models\Apprenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Routes principales de navigation (accueil et authentification).
Route::get('/', [PortalController::class, 'home'])->name('home');
Route::get('/login', [PortalController::class, 'showLogin'])->name('login.form');
Route::post('/login', [PortalController::class, 'login'])->name('login.submit');
Route::post('/logout', [PortalController::class, 'logout'])->name('logout');

// Page doctors avec recherche sur les apprenants.
Route::get('/doctors', [PortalController::class, 'doctors'])->name('doctors.index');

// Route GET simple pour afficher l'index des patients (vue Blade).
Route::get('/patients', function () {
    // Récupération de tous les enregistrements depuis le modèle Apprenant.
    $patients = Apprenant::all();

    // Envoi des données vers la vue sous la variable $patients.
    return view('patients.index', compact('patients'));
})->name('patients.index');

// Groupe de routes CRUD pour les apprenants.
Route::get('/apprenants', [ApprenantController::class, 'index'])->name('apprenants.index');
Route::get('/apprenants/create', [ApprenantController::class, 'create'])->name('apprenants.create');
Route::post('/apprenants', [ApprenantController::class, 'add'])->name('apprenants.add');
Route::get('/apprenants/{id}', [ApprenantController::class, 'getOne'])->name('apprenants.show');
Route::get('/apprenants/{id}/edit', [ApprenantController::class, 'updateForm'])->name('update.form');
Route::post('/apprenants/{id}', [ApprenantController::class, 'update'])->name('update');
Route::post('/apprenants/{id}/delete', [ApprenantController::class, 'delete'])->name('apprenants.delete');

// Endpoint simple pour un chatbot local (règles par mots-clés).
Route::post('/chatbot/reply', function (Request $request) {
    $message = mb_strtolower(trim((string) $request->input('message', '')));

    if ($message === '') {
        return response()->json(['reply' => 'Ecrivez votre question pour que je puisse vous aider.']);
    }

    if (str_contains($message, 'bonjour') || str_contains($message, 'salut')) {
        return response()->json(['reply' => 'Bonjour. Je peux vous aider pour les apprenants, patients, medecins et authentification.']);
    }

    if (str_contains($message, 'apprenant') || str_contains($message, 'ajouter')) {
        return response()->json(['reply' => 'Pour ajouter un apprenant, ouvrez "Ajouter", remplissez nom, age et maladie, puis cliquez sur Enregistrer.']);
    }

    if (str_contains($message, 'patient')) {
        return response()->json(['reply' => 'La page Patients affiche la liste rapide avec ID, nom, age et maladie.']);
    }

    if (str_contains($message, 'medecin') || str_contains($message, 'doctors')) {
        return response()->json(['reply' => 'La page Medecins permet la recherche des apprenants par nom.']);
    }

    if (str_contains($message, 'login') || str_contains($message, 'auth') || str_contains($message, 'connexion')) {
        return response()->json(['reply' => 'Passez par "Authentification" dans le menu pour vous connecter ou vous deconnecter.']);
    }

    return response()->json([
        'reply' => 'Je n\'ai pas compris exactement. Essayez avec: apprenant, patient, medecin, login.',
    ]);
})->name('chatbot.reply');
