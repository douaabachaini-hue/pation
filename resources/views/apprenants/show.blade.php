@extends('layouts.parent')

@section('title', 'Détail apprenant')

@section('content')
    <section class="card" style="max-width: 640px;">
        <h2>Détail de l'apprenant</h2>

        <p><strong>ID :</strong> {{ $apprenant->id }}</p>
        <p><strong>Nom :</strong> {{ $apprenant->nom }}</p>
        <p><strong>Âge :</strong> {{ $apprenant->age }}</p>
        <p><strong>Maladie :</strong> {{ $apprenant->maladie }}</p>
        <p><strong>Créé le :</strong> {{ $apprenant->created_at }}</p>
        <p><strong>Mis à jour le :</strong> {{ $apprenant->updated_at }}</p>

        <div class="inline-actions">
            <a class="btn btn-secondary" href="{{ route('update.form', $apprenant->id) }}">Modifier</a>
            <a class="btn btn-ghost" href="{{ route('apprenants.index') }}">Retour à la liste</a>
        </div>
    </section>
@endsection
