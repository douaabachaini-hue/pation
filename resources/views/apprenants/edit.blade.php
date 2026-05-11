@extends('layouts.parent')

@section('title', 'Modifier un apprenant')

@section('content')
    <section class="card" style="max-width: 640px;">
        <h2>Modifier un apprenant</h2>

        {{-- Les erreurs de validation s'affichent ici après une soumission invalide --}}
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

        <form action="{{ route('update', $apprenant->id) }}" method="POST" class="form-grid">
            @csrf
            <div>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom', $apprenant->nom) }}" required>
            </div>
            <div>
                <label for="age">Âge :</label>
                <input type="number" id="age" name="age" value="{{ old('age', $apprenant->age) }}" min="1" required>
            </div>
            <div>
                <label for="maladie">Maladie :</label>
                <input type="text" id="maladie" name="maladie" value="{{ old('maladie', $apprenant->maladie) }}" required>
            </div>
            <button class="btn btn-primary" type="submit">Mettre à jour</button>
        </form>

        <p><a href="{{ route('apprenants.index') }}">Retour à la liste</a></p>
    </section>
@endsection
