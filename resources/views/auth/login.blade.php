<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Sofrebak Gestion</title>
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
            top: 40px; right: 40px;
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
            padding: 3rem;
            background: #ffffff;
            position: relative;
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
            margin-bottom: 2rem;
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
            margin-bottom: 1.3rem;
        }

        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: 0.5rem;
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
            padding: 0.85rem 2.8rem 0.85rem 2.8rem;
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

        .form-input:focus + i,
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

        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .form-check input[type="checkbox"] {
            width: 18px; height: 18px;
            accent-color: #2563eb;
            cursor: pointer;
            border-radius: 5px;
        }

        .form-check span {
            font-size: 0.82rem;
            color: #64748b;
            font-weight: 500;
        }

        .form-forgot {
            font-size: 0.82rem;
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .form-forgot:hover { color: #1d4ed8; }

        /* Submit Button */
        .btn-auth {
            width: 100%;
            padding: 0.95rem;
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
            margin-bottom: 1.3rem;
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
        }

        .form-error i {
            color: #ef4444;
            font-size: 1rem;
            margin-top: 1px;
            flex-shrink: 0;
        }

        .form-error span {
            font-size: 0.82rem;
            color: #dc2626;
            font-weight: 500;
            line-height: 1.4;
        }

        /* Bottom Link */
        .auth-bottom {
            text-align: center;
            margin-top: 1.8rem;
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
                min-height: 320px;
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
                Accédez à votre espace de gestion pour gérer vos commandes, clients, stock et factures en toute simplicité.
            </p>
            <div class="branding-features">
                <div class="branding-feature">
                    <div class="branding-feature-icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <span>Tableau de bord en temps réel</span>
                </div>
                <div class="branding-feature">
                    <div class="branding-feature-icon"><i class="bi bi-shield-lock"></i></div>
                    <span>Données sécurisées et chiffrées</span>
                </div>
                <div class="branding-feature">
                    <div class="branding-feature-icon"><i class="bi bi-lightning-charge"></i></div>
                    <span>Interface rapide et intuitive</span>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT FORM -->
    <div class="auth-form-panel">
        <div class="auth-form-wrapper">
            <div class="auth-form-header">
                <h2>Bienvenue 👋</h2>
                <p>Connectez-vous à votre compte pour continuer</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; padding: 0.75rem 1rem; border-radius: 10px; margin-bottom: 1.3rem; font-size: 0.85rem; font-weight: 500; display: flex; align-items: center; gap: 0.6rem;">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="form-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Adresse Email</label>
                    <div class="form-input-wrapper">
                        <input type="email" class="form-input" id="email" name="email"
                               value="{{ old('email') }}" placeholder="votre@email.com" required autofocus>
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Mot de passe</label>
                    <div class="form-input-wrapper">
                        <input type="password" class="form-input" id="password" name="password"
                            placeholder="•••••••••" required>
                        <i class="bi bi-lock"></i>
                        <button type="button" class="toggle-password" onclick="togglePassword('password', this)">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-row">
                    <label class="form-check">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Se souvenir de moi</span>
                    </label>
                </div>

                <button type="submit" class="btn-auth">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Se connecter
                </button>
            </form>

            <div class="auth-bottom">
                Vous n'avez pas de compte ? <a href="{{ route('register') }}">Créer un compte</a>
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
    </script>
</body>
</html>
