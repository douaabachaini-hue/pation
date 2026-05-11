@extends('layouts.parent')

@section('title', 'CareConnect - Accueil')

@section('content')
    <section class="card hero">
        <h1 class="hero-title">Bienvenue sur CareConnect</h1>
        <p class="hero-sub">
            Une plateforme moderne de gestion des apprenants, avec authentification sécurisée
            et recherche rapide pour un suivi médical et pédagogique efficace.
        </p>

        <div class="actions">
            <a class="btn btn-primary" href="{{ route('login.form') }}">Commencer</a>
            <a class="btn btn-secondary" href="{{ route('doctors.index') }}">Découvrir la recherche</a>
            <a class="btn btn-ghost" href="{{ route('apprenants.index') }}">Voir les apprenants</a>
        </div>
    </section>

    <section class="features">
        <div class="section-head">
            <h2>Nos fonctionnalités</h2>
            <p>Des outils conçus pour simplifier la gestion quotidienne.</p>
        </div>

        <div class="feature-grid">
            <article class="feature-card">
                <div class="feature-icon">🗂️</div>
                <h3>Gestion des dossiers</h3>
                <p>Créez, modifiez et suivez chaque apprenant en quelques clics.</p>
            </article>
            <article class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3>Sécurité renforcée</h3>
                <p>Accès contrôlé avec authentification et sessions protégées.</p>
            </article>
            <article class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Recherche rapide</h3>
                <p>Trouvez instantanément un patient ou un apprenant par son nom.</p>
            </article>
            <article class="feature-card">
                <div class="feature-icon">📈</div>
                <h3>Suivi évolutif</h3>
                <p>Visualisez les informations essentielles pour mieux décider.</p>
            </article>
            <article class="feature-card">
                <div class="feature-icon">🌐</div>
                <h3>Interface moderne</h3>
                <p>Design professionnel, responsive et agréable sur tout écran.</p>
            </article>
            <article class="feature-card">
                <div class="feature-icon">🤝</div>
                <h3>Collaboration</h3>
                <p>Une base commune pour médecins, secrétaires et encadrants.</p>
            </article>
        </div>
    </section>

    <section class="cta-band">
        <h2>Prêt à démarrer avec CareConnect ?</h2>
        <p>Rejoignez une nouvelle expérience de gestion médicale claire et efficace.</p>
        <a class="btn btn-primary" href="{{ route('login.form') }}">Créer un compte de démonstration</a>
    </section>
@endsection
