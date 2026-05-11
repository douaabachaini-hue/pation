@extends('layouts.parent')

@section('title', 'Ajouter un apprenant')

@section('content')
    <section class="card" style="max-width: 640px;">
        <h2>Ajouter un apprenant</h2>

        {{-- Affichage des erreurs de validation renvoyées par Laravel --}}
        @if ($errors->any())
            <div class="alert alert-error">
                <p>Veuillez corriger les erreurs suivantes :</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('apprenants.add') }}" method="POST" class="form-grid">
            @csrf
            <div>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>
            </div>
            <div>
                <label for="age">Âge :</label>
                <input type="number" id="age" name="age" value="{{ old('age') }}" min="1" required>
            </div>
            <div>
                <label for="maladie">Maladie :</label>
                <input type="text" id="maladie" name="maladie" value="{{ old('maladie') }}" required>
            </div>
            <button class="btn btn-primary" type="submit">Enregistrer</button>
        </form>
    </section>
@endsection
