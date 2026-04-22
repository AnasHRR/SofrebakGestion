<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte — Sofrebak Gestion</title>
    <link rel="icon" type="image/png" href="{{ asset('logo_Sofrebak.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #0b1735;
            overflow: hidden;
        }

        /* ═══════════════════════════════
           LEFT PANEL — BRANDING
        ═══════════════════════════════ */
        .auth-branding {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #0b1735 0%, #0e2266 40%, #1e3a8a 100%);
        }

        .auth-branding::before {
            content: '';
            position: absolute;
            top: -200px; right: -200px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.12), transparent 70%);
            border-radius: 50%;
            animation: pulse-glow 6s ease-in-out infinite;
        }

        .auth-branding::after {
            content: '';
            position: absolute;
            bottom: -150px; left: -150px;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(96, 165, 250, 0.08), transparent 70%);
            border-radius: 50%;
            animation: pulse-glow 8s ease-in-out infinite reverse;
        }

        @keyframes pulse-glow {
            0%, 100% { transform: scale(1); opacity: 0.6; }
            50% { transform: scale(1.15); opacity: 1; }
        }

        .branding-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 420px;
        }

        .branding-logo {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, #0e2266, #0a1740);
            border-radius: 22px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.8rem;
            box-shadow: 0 12px 40px rgba(10, 23, 64, 0.4);
            position: relative;
        }

        .branding-logo::after {
            content: '';
            position: absolute;
            inset: -5px;
            border-radius: 27px;
            border: 2px solid rgba(96, 165, 250, 0.25);
            animation: pulse-glow 3s ease-in-out infinite;
        }

        .branding-logo i { color: #fff; font-size: 2rem; }

        .branding-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.5px;
            margin-bottom: 0.5rem;
        }

        .branding-subtitle {
            font-size: 0.75rem;
            color: #60a5fa;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-bottom: 2rem;
        }

        .branding-desc {
            font-size: 1rem;
            color: rgba(255,255,255,0.55);
            line-height: 1.7;
            margin-bottom: 2.5rem;
        }

        .branding-features {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            text-align: left;
        }

        .branding-feature {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.9rem 1.2rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            transition: all 0.3s ease;
        }

        .branding-feature:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(96, 165, 250, 0.3);
            transform: translateX(6px);
        }

        .branding-feature-icon {
            width: 42px; height: 42px;
            background: rgba(37, 99, 235, 0.2);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .branding-feature-icon i { color: #60a5fa; font-size: 1.1rem; }

        .branding-feature span {
            color: rgba(255,255,255,0.7);
            font-size: 0.88rem;
            font-weight: 500;
        }

        /* Decorative grid dots */
        .grid-dots {
            position: absolute;
            bottom: 40px; left: 40px;
            display: grid;
            grid-template-columns: repeat(5, 8px);
            gap: 12px;
            z-index: 1;
        }

        .grid-dots span {
            width: 4px; height: 4px;
            background: rgba(96, 165, 250, 0.2);
            border-radius: 50%;
        }

        /* ═══════════════════════════════
           RIGHT PANEL — FORM
        ═══════════════════════════════ */
        .auth-form-panel {
            width: 520px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2.5rem 3rem;
            background: #ffffff;
            position: relative;
            overflow-y: auto;
        }

        .auth-form-panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0; bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, #2563eb, #60a5fa, #2563eb);
            background-size: 100% 200%;
            animation: gradient-slide 4s linear infinite;
        }

        @keyframes gradient-slide {
            0% { background-position: 0% 0%; }
            100% { background-position: 0% 200%; }
        }

        .auth-form-wrapper {
            width: 100%;
            max-width: 380px;
        }

        .auth-form-header {
            margin-bottom: 1.5rem;
        }

        .auth-form-header h2 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #0f1e4a;
            letter-spacing: -0.5px;
            margin-bottom: 0.5rem;
        }

        .auth-form-header p {
            font-size: 0.9rem;
            color: #94a3b8;
            font-weight: 500;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 1.1rem;
        }

        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: 0.45rem;
            letter-spacing: 0.3px;
        }

        .form-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-input-wrapper > i {
            position: absolute;
            left: 14px;
            color: #94a3b8;
            font-size: 1rem;
            transition: color 0.3s ease;
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.8rem;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.9rem;
            font-family: inherit;
            font-weight: 500;
            color: #0f1e4a;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input::placeholder {
            color: #cbd5e1;
        }

        .form-input:focus {
            border-color: #2563eb;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .form-input-wrapper:focus-within > i {
            color: #2563eb;
        }

        .form-input-wrapper .toggle-password {
            position: absolute;
            right: 14px;
            left: auto;
            background: none;
            border: none;
            cursor: pointer;
            color: #94a3b8;
            font-size: 1rem;
            padding: 4px;
            transition: color 0.2s ease;
        }

        .form-input-wrapper .toggle-password:hover {
            color: #2563eb;
        }

        /* Password Strength */
        .password-strength {
            margin-top: 0.5rem;
            display: flex;
            gap: 4px;
        }

        .strength-bar {
            flex: 1;
            height: 3px;
            background: #e2e8f0;
            border-radius: 2px;
            transition: background 0.3s ease;
        }

        .strength-bar.active.weak { background: #ef4444; }
        .strength-bar.active.medium { background: #f59e0b; }
        .strength-bar.active.strong { background: #22c55e; }

        .strength-text {
            font-size: 0.7rem;
            font-weight: 600;
            margin-top: 0.3rem;
            transition: color 0.3s ease;
        }

        .strength-text.weak { color: #ef4444; }
        .strength-text.medium { color: #f59e0b; }
        .strength-text.strong { color: #22c55e; }

        /* Submit Button */
        .btn-auth {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, #2563eb, #1e3a8a);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.35);
            letter-spacing: 0.3px;
            margin-top: 1.3rem;
        }

        .btn-auth:hover {
            background: linear-gradient(135deg, #1d4ed8, #0e2266);
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(37, 99, 235, 0.45);
        }

        .btn-auth:active {
            transform: translateY(0);
        }

        /* Error Message */
        .form-error {
            background: #fef2f2;
            border: 1px solid #fee2e2;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
        }

        .form-error ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .form-error li {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            font-size: 0.8rem;
            color: #dc2626;
            font-weight: 500;
            line-height: 1.4;
            padding: 2px 0;
        }

        .form-error li::before {
            content: '•';
            color: #ef4444;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* Bottom link */
        .auth-bottom {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: #94a3b8;
            font-weight: 500;
        }

        .auth-bottom a {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .auth-bottom a:hover { color: #1d4ed8; }

        /* Back to Site */
        .back-to-site {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
            z-index: 10;
        }

        .back-to-site:hover { color: #fff; }
        .back-to-site i { font-size: 0.9rem; }

        /* ═══════════════════════════════
           RESPONSIVE
        ═══════════════════════════════ */
        @media (max-width: 960px) {
            body { flex-direction: column; overflow: auto; }
            .auth-branding {
                min-height: 280px;
                padding: 2rem 1.5rem;
            }
            .branding-features { display: none; }
            .branding-desc { margin-bottom: 0; }
            .auth-form-panel {
                width: 100%;
                padding: 2rem 1.5rem;
            }
            .auth-form-panel::before { display: none; }
        }

        @media (max-width: 480px) {
            .branding-title { font-size: 1.6rem; }
            .branding-desc { font-size: 0.88rem; }
            .auth-form-header h2 { font-size: 1.4rem; }
        }
    </style>
</head>
<body>

    <!-- LEFT BRANDING -->
    <div class="auth-branding">
        <a href="/" class="back-to-site">
            <i class="bi bi-arrow-left"></i> Retour au site
        </a>

        <div class="grid-dots">
            <span></span><span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span><span></span><span></span>
        </div>

        <div class="branding-content">
            <div class="branding-logo">
                <img src="{{ asset('logo_Sofrebak.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            <div class="branding-title">Sofrebak</div>
            <div class="branding-subtitle">Management System</div>
            <p class="branding-desc">
                Créez votre compte et commencez à gérer votre entreprise de manière efficace et professionnelle.
            </p>
            <div class="branding-features">
                <div class="branding-feature">
                    <div class="branding-feature-icon"><i class="bi bi-person-plus"></i></div>
                    <span>Inscription rapide en quelques secondes</span>
                </div>
                <div class="branding-feature">
                    <div class="branding-feature-icon"><i class="bi bi-unlock"></i></div>
                    <span>Accès complet à toutes les fonctionnalités</span>
                </div>
                <div class="branding-feature">
                    <div class="branding-feature-icon"><i class="bi bi-cloud-check"></i></div>
                    <span>Sauvegarde automatique dans le cloud</span>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT FORM -->
    <div class="auth-form-panel">
        <div class="auth-form-wrapper">
            <div class="auth-form-header">
                <h2>Créer un compte ✨</h2>
                <p>Remplissez les informations ci-dessous pour commencer</p>
            </div>

            @if ($errors->any())
                <div class="form-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="name">Nom complet</label>
                    <div class="form-input-wrapper">
                        <input type="text" class="form-input" id="name" name="name"
                               value="{{ old('name') }}" placeholder="Votre nom complet" required autofocus>
                        <i class="bi bi-person"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Adresse Email</label>
                    <div class="form-input-wrapper">
                        <input type="email" class="form-input" id="email" name="email"
                               value="{{ old('email') }}" placeholder="votre@email.com" required>
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Mot de passe</label>
                    <div class="form-input-wrapper">
                        <input type="password" class="form-input" id="password" name="password"
                               placeholder="Minimum 8 caractères" required oninput="checkStrength(this.value)">
                        <i class="bi bi-lock"></i>
                        <button type="button" class="toggle-password" onclick="togglePassword('password', this)">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar" id="str1"></div>
                        <div class="strength-bar" id="str2"></div>
                        <div class="strength-bar" id="str3"></div>
                        <div class="strength-bar" id="str4"></div>
                    </div>
                    <div class="strength-text" id="strengthText"></div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirmer le mot de passe</label>
                    <div class="form-input-wrapper">
                        <input type="password" class="form-input" id="password_confirmation" name="password_confirmation"
                               placeholder="Retapez votre mot de passe" required>
                        <i class="bi bi-lock-fill"></i>
                        <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', this)">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-auth">
                    <i class="bi bi-person-plus"></i>
                    Créer mon compte
                </button>
            </form>

            <div class="auth-bottom">
                Vous avez déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
            </div>
        </div>
    </div>

    <script>
        // Prevent back history after logout
        (function () {
            window.history.pushState(null, null, window.location.href);
            window.onpopstate = function () {
                window.history.pushState(null, null, window.location.href);
            };
        })();

        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye';
            }
        }

        function checkStrength(password) {
            const bars = [
                document.getElementById('str1'),
                document.getElementById('str2'),
                document.getElementById('str3'),
                document.getElementById('str4')
            ];
            const text = document.getElementById('strengthText');

            // Reset
            bars.forEach(b => { b.className = 'strength-bar'; });
            text.textContent = '';
            text.className = 'strength-text';

            if (password.length === 0) return;

            let score = 0;
            if (password.length >= 8) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;

            let level = 'weak';
            let label = 'Faible';
            if (score >= 4) { level = 'strong'; label = 'Fort'; }
            else if (score >= 2) { level = 'medium'; label = 'Moyen'; }

            for (let i = 0; i < score; i++) {
                bars[i].classList.add('active', level);
            }
            text.textContent = label;
            text.classList.add(level);
        }
    </script>
</body>
</html>
