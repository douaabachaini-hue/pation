@extends('layouts.parent')

@section('title', 'Patients')

@section('content')
    <section class="card">
        <h2>Patients (Apprenants)</h2>
        <p class="lead">Liste rapide des patients enregistrés.</p>

        @php
            // Support de $patients ou $apprenants selon la route utilisée.
            $rows = $patients ?? $apprenants ?? collect();
        @endphp

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width: 120px;">ID</th>
                        <th>Nom</th>
                        <th>Âge</th>
                        <th>Maladie</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rows as $patient)
                        <tr>
                            <td>{{ $patient->id }}</td>
                            <td>{{ $patient->nom ?? $patient->name ?? 'N/A' }}</td>
                            <td>{{ $patient->age ?? '' }}</td>
                            <td>{{ $patient->maladie ?? '' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Aucun patient trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
