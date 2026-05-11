@extends('layouts.parent')

@section('title', 'Liste des apprenants')

@section('content')
    <section class="card">
        <h2>Liste des apprenants</h2>
        <p class="lead">Gestion complète: affichage, détail, modification et suppression.</p>

        @if ($apprenants->isEmpty())
            <p>Aucun apprenant enregistré pour le moment.</p>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Âge</th>
                            <th>Maladie</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apprenants as $apprenant)
                            <tr>
                                <td>{{ $apprenant->id }}</td>
                                <td>{{ $apprenant->nom }}</td>
                                <td>{{ $apprenant->age }}</td>
                                <td>{{ $apprenant->maladie }}</td>
                                <td>
                                    <div class="inline-actions">
                                        <a class="btn btn-ghost" href="{{ route('apprenants.show', $apprenant->id) }}">Voir</a>
                                        <a class="btn btn-secondary" href="{{ route('update.form', $apprenant->id) }}">Modifier</a>
                                        <form class="inline-form" action="{{ route('apprenants.delete', $apprenant->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-primary" type="submit" onclick="return confirm('Confirmer la suppression ?');">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endsection
