@extends('layouts.parent')

@section('title', 'Médecins - Recherche')

@section('content')
    <section class="card">
        <h2>Recherche des médecins</h2>
        <p class="lead">Recherche des apprenants par nom.</p>

        <form action="{{ route('doctors.index') }}" method="GET" class="search-bar">
            <input id="search" type="text" name="search" value="{{ $search }}" placeholder="Rechercher un nom (ex: Ali)">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
    </section>

    <section class="card" style="margin-top: 16px;">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Âge</th>
                        <th>Maladie</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patients as $patient)
                        <tr>
                            <td>{{ $patient->id }}</td>
                            <td>{{ $patient->nom }}</td>
                            <td>{{ $patient->age }}</td>
                            <td>{{ $patient->maladie ?? '' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Aucun résultat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
