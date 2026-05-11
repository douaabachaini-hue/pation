<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CareConnect')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>
    {{-- Layout principal partagé: en-tête, navigation et contenu central --}}
    <header class="topbar">
        <div class="container nav-wrap">
            <a class="brand" href="{{ route('home') }}">CareConnect</a>

            <nav class="nav-links">
                <a href="{{ route('home') }}">Accueil</a>
                <a href="{{ route('apprenants.index') }}">Apprenants</a>
                <a href="{{ route('apprenants.create') }}">Ajouter</a>
                <a href="{{ route('patients.index') }}">Patients</a>
                <a href="{{ route('doctors.index') }}">Médecins</a>
                <a href="{{ route('login.form') }}">Authentification</a>
            </nav>

            @if (session('is_authenticated'))
                <div class="session-box">
                    <span>{{ session('user_email') }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-ghost">Déconnexion</button>
                    </form>
                </div>
            @endif
        </div>
    </header>

    <main class="container page">
        {{-- Messages flash globaux affichés sur toutes les pages --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        {{-- Zone remplie par chaque vue enfant --}}
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div>
                <h3>CareConnect</h3>
                <p>Plateforme de gestion des apprenants et dossiers médicaux.</p>
            </div>
            <div>
                <h3>Navigation</h3>
                <p><a href="{{ route('home') }}">Accueil</a></p>
                <p><a href="{{ route('apprenants.index') }}">Apprenants</a></p>
            </div>
            <div>
                <h3>Services</h3>
                <p><a href="{{ route('doctors.index') }}">Recherche médecins</a></p>
                <p><a href="{{ route('patients.index') }}">Liste des patients</a></p>
            </div>
            <div>
                <h3>Contact</h3>
                <p>Email: support@careconnect.local</p>
                <p>Tél: +33 1 00 00 00 00</p>
            </div>
        </div>
    </footer>

    <button id="chatbot-toggle" class="chatbot-toggle" type="button" aria-label="Ouvrir le chat">
        Chat
    </button>

    <section id="chatbot-panel" class="chatbot-panel" aria-live="polite">
        <header class="chatbot-header">Assistant CareConnect</header>
        <div id="chatbot-messages" class="chatbot-messages">
            <div class="chatbot-msg bot">Bonjour. Posez une question sur le site.</div>
        </div>
        <form id="chatbot-form" class="chatbot-form">
            <input id="chatbot-input" type="text" placeholder="Ecrivez ici..." autocomplete="off" required>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </section>

    <script>
        (function () {
            const panel = document.getElementById('chatbot-panel');
            const toggle = document.getElementById('chatbot-toggle');
            const form = document.getElementById('chatbot-form');
            const input = document.getElementById('chatbot-input');
            const messages = document.getElementById('chatbot-messages');
            const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            const addMessage = (text, cls) => {
                const row = document.createElement('div');
                row.className = `chatbot-msg ${cls}`;
                row.textContent = text;
                messages.appendChild(row);
                messages.scrollTop = messages.scrollHeight;
            };

            toggle.addEventListener('click', function () {
                panel.classList.toggle('open');
            });

            form.addEventListener('submit', async function (event) {
                event.preventDefault();
                const text = input.value.trim();
                if (!text) return;

                addMessage(text, 'user');
                input.value = '';

                try {
                    const response = await fetch('{{ route('chatbot.reply') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ message: text })
                    });

                    if (!response.ok) throw new Error('Request failed');
                    const data = await response.json();
                    addMessage(data.reply || 'Aucune reponse.', 'bot');
                } catch (error) {
                    addMessage('Erreur de connexion au chatbot.', 'bot');
                }
            });
        })();
    </script>
</body>
</html>
