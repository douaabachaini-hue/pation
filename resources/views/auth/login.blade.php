@extends('layouts.parent')

@section('title', 'Authentification')

@section('content')
    <section class="card" style="max-width: 520px; margin: 0 auto;">
        <h2>Authentification</h2>
        <p class="lead">
            Compte de démonstration: <strong>admin@demo.com</strong> / <strong>admin1234</strong>
        </p>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="form-grid">
            @csrf
            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div>
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </section>
@endsection
