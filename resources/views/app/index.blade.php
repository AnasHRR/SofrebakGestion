<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sofrebak — Gestion Intelligente pour Matériaux de Construction</title>
    <meta name="description" content="Sofrebak : la plateforme de gestion tout-en-un pour les entreprises de matériaux de construction. Commandes, stock, factures et clients en un seul endroit.">
    <link rel="icon" type="image/gif" href="{{ asset('logo_page.gif') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* ═══════════════════════════════
           RESET & BASE
        ═══════════════════════════════ */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --blue-950: #06102b;
            --blue-900: #0a1740;
            --blue-800: #0e2266;
            --blue-700: #1e3a8a;
            --blue-600: #1d4ed8;
            --blue-500: #2563eb;
            --blue-400: #3b82f6;
            --blue-300: #60a5fa;
            --blue-200: #93c5fd;
            --blue-100: #bfdbfe;
            --blue-50:  #eff6ff;
            --slate-900: #0f172a;
            --slate-800: #1e293b;
            --slate-700: #334155;
            --slate-600: #475569;
            --slate-500: #64748b;
            --slate-400: #94a3b8;
            --slate-300: #cbd5e1;
            --slate-200: #e2e8f0;
            --slate-100: #f1f5f9;
            --slate-50:  #f8fafc;
            --white: #ffffff;
            --amber-500: #f59e0b;
            --green-500: #22c55e;
            --green-400: #4ade80;
            --red-500: #ef4444;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--slate-800);
            line-height: 1.6;
            overflow-x: hidden;
            background: var(--white);
        }

        a { text-decoration: none; color: inherit; }
        ul, ol { list-style: none; }
        img { max-width: 100%; display: block; }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* ═══════════════════════════════
           NAVBAR
        ═══════════════════════════════ */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar.scrolled {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(226,232,240,0.6);
            box-shadow: 0 4px 30px rgba(0,0,0,0.06);
            padding: 0.7rem 0;
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nav-logo-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
            border-radius: 13px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 6px 20px rgba(37,99,235,0.35);
            transition: transform 0.3s ease;
        }

        .nav-logo:hover .nav-logo-icon { transform: rotate(-5deg) scale(1.05); }

        .nav-logo-icon i { color: var(--white); font-size: 1.3rem; }

        .nav-logo-text {
            font-size: 1.4rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--white);
            transition: color 0.3s ease;
        }

        .navbar.scrolled .nav-logo-text { color: var(--slate-900); }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .nav-links a {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: rgba(255,255,255,0.75);
            border-radius: 10px;
            transition: all 0.25s ease;
        }

        .nav-links a:hover {
            color: var(--white);
            background: rgba(255,255,255,0.1);
        }

        .navbar.scrolled .nav-links a { color: var(--slate-600); }
        .navbar.scrolled .nav-links a:hover {
            color: var(--blue-600);
            background: var(--blue-50);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nav-btn {
            padding: 0.55rem 1.3rem;
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .nav-btn-ghost {
            background: transparent;
            color: rgba(255,255,255,0.85);
            border: 1.5px solid rgba(255,255,255,0.25);
        }

        .nav-btn-ghost:hover {
            background: rgba(255,255,255,0.12);
            border-color: rgba(255,255,255,0.5);
            color: var(--white);
        }

        .navbar.scrolled .nav-btn-ghost {
            color: var(--slate-700);
            border-color: var(--slate-300);
        }

        .navbar.scrolled .nav-btn-ghost:hover {
            background: var(--slate-100);
            border-color: var(--slate-400);
        }

        .nav-btn-primary {
            background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
            color: var(--white);
            box-shadow: 0 4px 14px rgba(37,99,235,0.4);
        }

        .nav-btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37,99,235,0.5);
        }

        /* Mobile Menu */
        .nav-hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 5px;
            background: none;
            border: none;
        }

        .nav-hamburger span {
            width: 24px; height: 2.5px;
            background: var(--white);
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .navbar.scrolled .nav-hamburger span { background: var(--slate-700); }

        .nav-hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
        .nav-hamburger.active span:nth-child(2) { opacity: 0; }
        .nav-hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }

        /* ═══════════════════════════════
           HERO SECTION
        ═══════════════════════════════ */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--blue-950) 0%, var(--blue-900) 30%, var(--blue-800) 70%, var(--blue-700) 100%);
            position: relative;
            overflow: hidden;
            padding: 7rem 0 5rem;
        }

        /* Animated grid */
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(59,130,246,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,0.06) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse at 50% 50%, black 30%, transparent 75%);
            -webkit-mask-image: radial-gradient(ellipse at 50% 50%, black 30%, transparent 75%);
        }

        /* Glow orbs */
        .hero-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
        }

        .hero-orb-1 {
            width: 500px; height: 500px;
            background: var(--blue-600);
            top: -150px; right: -100px;
            animation: orb-float 8s ease-in-out infinite;
        }

        .hero-orb-2 {
            width: 350px; height: 350px;
            background: var(--blue-500);
            bottom: -80px; left: -80px;
            animation: orb-float 10s ease-in-out infinite reverse;
        }

        .hero-orb-3 {
            width: 200px; height: 200px;
            background: rgba(96,165,250,0.3);
            top: 40%; left: 30%;
            animation: orb-float 6s ease-in-out infinite 2s;
        }

        @keyframes orb-float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -20px) scale(1.05); }
            66% { transform: translate(-20px, 15px) scale(0.95); }
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .hero-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(59,130,246,0.15);
            border: 1px solid rgba(96,165,250,0.25);
            padding: 0.45rem 1.2rem;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--blue-200);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
        }

        .hero-badge i { font-size: 0.7rem; }

        .hero-badge .dot {
            width: 6px; height: 6px;
            background: var(--green-400);
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(74,222,128,0.6);
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.3); }
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 900;
            color: var(--white);
            line-height: 1.1;
            letter-spacing: -1.5px;
            margin-bottom: 1.5rem;
        }

        .hero h1 .gradient-text {
            background: linear-gradient(135deg, var(--blue-300), var(--blue-100));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-desc {
            font-size: 1.15rem;
            color: rgba(255,255,255,0.55);
            max-width: 600px;
            margin: 0 auto 2.5rem;
            line-height: 1.8;
        }

        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 4rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.9rem 2rem;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            letter-spacing: 0.2px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--blue-500), var(--blue-600));
            color: var(--white);
            box-shadow: 0 8px 30px rgba(37,99,235,0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(37,99,235,0.55);
        }

        .btn-outline-light {
            background: transparent;
            color: rgba(255,255,255,0.85);
            border: 2px solid rgba(255,255,255,0.2);
        }

        .btn-outline-light:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.4);
            color: var(--white);
            transform: translateY(-2px);
        }

        /* Hero Dashboard Preview */
        .hero-preview {
            max-width: 950px;
            margin: 0 auto;
            perspective: 1200px;
        }

        .hero-preview-window {
            background: var(--slate-900);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow:
                0 40px 80px rgba(0,0,0,0.4),
                0 0 0 1px rgba(255,255,255,0.05) inset;
            transform: rotateX(4deg);
            transition: transform 0.5s ease;
        }

        .hero-preview-window:hover {
            transform: rotateX(0deg);
        }

        .preview-topbar {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0.8rem 1.2rem;
            background: rgba(0,0,0,0.3);
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .preview-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
        }

        .preview-dot-red { background: #ef4444; }
        .preview-dot-yellow { background: #f59e0b; }
        .preview-dot-green { background: #22c55e; }

        .preview-url {
            flex: 1;
            text-align: center;
            font-size: 0.72rem;
            color: rgba(255,255,255,0.3);
            font-weight: 600;
        }

        .preview-body {
            display: grid;
            grid-template-columns: 200px 1fr;
            min-height: 380px;
        }

        .preview-sidebar {
            background: var(--blue-900);
            padding: 1.2rem 0.8rem;
            border-right: 1px solid rgba(255,255,255,0.06);
        }

        .preview-sidebar-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0 0.4rem;
            margin-bottom: 1.5rem;
        }

        .preview-sidebar-logo-box {
            width: 28px; height: 28px;
            background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }

        .preview-sidebar-logo-box i { color: var(--white); font-size: 0.7rem; }

        .preview-sidebar-logo span {
            font-size: 0.78rem;
            font-weight: 800;
            color: var(--white);
        }

        .preview-nav-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.55rem 0.7rem;
            border-radius: 8px;
            margin-bottom: 3px;
            font-size: 0.72rem;
            color: rgba(255,255,255,0.5);
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .preview-nav-item.active {
            background: linear-gradient(135deg, var(--blue-600), var(--blue-800));
            color: var(--white);
            box-shadow: 0 4px 12px rgba(37,99,235,0.3);
        }

        .preview-nav-item i { font-size: 0.8rem; }

        .preview-main {
            background: #f0f4ff;
            padding: 1.2rem;
        }

        .preview-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.7rem;
            margin-bottom: 1rem;
        }

        .preview-stat-card {
            background: var(--white);
            border-radius: 10px;
            padding: 0.9rem;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }

        .preview-stat-label {
            font-size: 0.6rem;
            color: var(--slate-400);
            font-weight: 600;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .preview-stat-value {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--slate-900);
            letter-spacing: -0.5px;
        }

        .preview-stat-change {
            font-size: 0.6rem;
            font-weight: 700;
            margin-top: 3px;
        }

        .preview-stat-change.up { color: var(--green-500); }

        .preview-chart-area {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 0.7rem;
        }

        .preview-chart-box {
            background: var(--white);
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }

        .preview-chart-title {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--slate-700);
            margin-bottom: 0.7rem;
        }

        .preview-chart-bars {
            display: flex;
            align-items: flex-end;
            gap: 6px;
            height: 100px;
        }

        .preview-bar {
            flex: 1;
            background: linear-gradient(180deg, var(--blue-400), var(--blue-600));
            border-radius: 4px 4px 0 0;
            min-height: 15px;
            animation: bar-grow 1.5s ease-out forwards;
            transform-origin: bottom;
        }

        @keyframes bar-grow {
            from { transform: scaleY(0); }
            to { transform: scaleY(1); }
        }

        .preview-list-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--slate-100);
        }

        .preview-list-item:last-child { border-bottom: none; }

        .preview-list-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .preview-list-text {
            font-size: 0.65rem;
            color: var(--slate-600);
            font-weight: 500;
        }

        .preview-list-value {
            margin-left: auto;
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--slate-800);
        }

        /* ═══════════════════════════════
           CLIENTS SECTION (Logo bar)
        ═══════════════════════════════ */
        .clients {
            padding: 3.5rem 0;
            background: var(--slate-50);
            border-bottom: 1px solid var(--slate-200);
        }

        .clients-label {
            text-align: center;
            font-size: 0.78rem;
            color: var(--slate-400);
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
        }

        .clients-logos {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 3.5rem;
            flex-wrap: wrap;
        }

        .client-logo {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--slate-300);
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: color 0.3s ease;
            cursor: default;
        }

        .client-logo:hover { color: var(--blue-500); }

        /* ═══════════════════════════════
           FEATURES SECTION
        ═══════════════════════════════ */
        .features {
            padding: 7rem 0;
            background: var(--white);
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--blue-600);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .section-label i {
            width: 22px; height: 22px;
            background: var(--blue-50);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem;
        }

        .section-title {
            font-size: 2.8rem;
            font-weight: 900;
            color: var(--slate-900);
            letter-spacing: -1px;
            line-height: 1.15;
            margin-bottom: 1rem;
        }

        .section-desc {
            font-size: 1.05rem;
            color: var(--slate-500);
            max-width: 560px;
            line-height: 1.75;
        }

        .features-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .features-header .section-desc { margin: 0 auto; }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .feature-card {
            padding: 2.2rem;
            border-radius: 18px;
            background: var(--white);
            border: 1px solid var(--slate-200);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--blue-400), var(--blue-600));
            transform: scaleX(0);
            transition: transform 0.35s ease;
            transform-origin: left;
        }

        .feature-card:hover {
            border-color: var(--blue-200);
            transform: translateY(-6px);
            box-shadow: 0 16px 50px rgba(37,99,235,0.1);
        }

        .feature-card:hover::before { transform: scaleX(1); }

        .feature-icon {
            width: 56px; height: 56px;
            border-radius: 15px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 1.4rem;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon { transform: scale(1.1) rotate(-3deg); }

        .feature-icon.blue { background: var(--blue-50); color: var(--blue-500); }
        .feature-icon.amber { background: #fffbeb; color: var(--amber-500); }
        .feature-icon.green { background: #f0fdf4; color: var(--green-500); }
        .feature-icon.red { background: #fef2f2; color: var(--red-500); }
        .feature-icon.purple { background: #faf5ff; color: #8b5cf6; }
        .feature-icon.cyan { background: #ecfeff; color: #06b6d4; }

        .feature-title {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--slate-900);
            margin-bottom: 0.6rem;
            letter-spacing: -0.3px;
        }

        .feature-desc {
            font-size: 0.88rem;
            color: var(--slate-500);
            line-height: 1.7;
        }

        /* ═══════════════════════════════
           HOW IT WORKS
        ═══════════════════════════════ */
        .how-it-works {
            padding: 7rem 0;
            background: var(--slate-50);
        }

        .how-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .how-header .section-desc { margin: 0 auto; }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            position: relative;
        }

        .steps-grid::before {
            content: '';
            position: absolute;
            top: 42px;
            left: 12%;
            right: 12%;
            height: 2px;
            background: linear-gradient(90deg, var(--blue-200), var(--blue-400), var(--blue-200));
            z-index: 0;
        }

        .step-card {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .step-number {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.3rem;
            font-size: 1.2rem;
            font-weight: 900;
            color: var(--white);
            box-shadow: 0 8px 25px rgba(37,99,235,0.35);
            border: 4px solid var(--slate-50);
            transition: all 0.3s ease;
        }

        .step-card:hover .step-number {
            transform: scale(1.1) rotate(-5deg);
            box-shadow: 0 12px 35px rgba(37,99,235,0.45);
        }

        .step-title {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--slate-900);
            margin-bottom: 0.5rem;
        }

        .step-desc {
            font-size: 0.85rem;
            color: var(--slate-500);
            line-height: 1.65;
        }

        /* ═══════════════════════════════
           STATS SECTION
        ═══════════════════════════════ */
        .stats {
            padding: 5rem 0;
            background: linear-gradient(135deg, var(--blue-900), var(--blue-800));
            position: relative;
            overflow: hidden;
        }

        .stats::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 20% 50%, rgba(59,130,246,0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(96,165,250,0.1) 0%, transparent 50%);
        }

        .stats .container {
            position: relative;
            z-index: 1;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }

        .stat-card {
            text-align: center;
            padding: 1.5rem;
        }

        .stat-value {
            font-size: 3rem;
            font-weight: 900;
            color: var(--white);
            letter-spacing: -1px;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-value span { color: var(--blue-300); }

        .stat-label {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.5);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        /* ═══════════════════════════════
           PRICING / CTA SECTION
        ═══════════════════════════════ */
        .cta {
            padding: 7rem 0;
            background: var(--white);
        }

        .cta-wrapper {
            text-align: center;
            max-width: 700px;
            margin: 0 auto;
            padding: 4rem 3rem;
            background: linear-gradient(135deg, var(--blue-600), var(--blue-800));
            border-radius: 28px;
            position: relative;
            overflow: hidden;
        }

        .cta-wrapper::before {
            content: '';
            position: absolute;
            top: -50%; right: -20%;
            width: 400px; height: 400px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .cta-wrapper::after {
            content: '';
            position: absolute;
            bottom: -40%; left: -15%;
            width: 300px; height: 300px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
        }

        .cta-content {
            position: relative;
            z-index: 1;
        }

        .cta-content h2 {
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--white);
            letter-spacing: -0.5px;
            margin-bottom: 1rem;
        }

        .cta-content p {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.65);
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .btn-white {
            background: var(--white);
            color: var(--blue-700);
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        }

        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.2);
        }

        .cta-note {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.45);
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
        }

        /* ═══════════════════════════════
           FOOTER
        ═══════════════════════════════ */
        .footer {
            background: var(--slate-900);
            padding: 4rem 0 0;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1fr;
            gap: 3rem;
            padding-bottom: 3rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .footer-brand-text {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            margin-bottom: 1.2rem;
        }

        .footer-brand-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 6px 20px rgba(37,99,235,0.35);
        }

        .footer-brand-icon i { color: var(--white); font-size: 1.1rem; }

        .footer-brand-name {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--white);
        }

        .footer-brand p {
            font-size: 0.88rem;
            color: rgba(255,255,255,0.4);
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .footer-socials {
            display: flex;
            gap: 0.6rem;
        }

        .footer-socials a {
            width: 38px; height: 38px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 10px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.4);
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .footer-socials a:hover {
            background: var(--blue-600);
            border-color: var(--blue-600);
            color: var(--white);
            transform: translateY(-2px);
        }

        .footer-col h4 {
            font-size: 0.8rem;
            font-weight: 800;
            color: var(--white);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 1.3rem;
        }

        .footer-col ul li { margin-bottom: 0.6rem; }

        .footer-col ul li a {
            font-size: 0.88rem;
            color: rgba(255,255,255,0.4);
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .footer-col ul li a:hover {
            color: var(--blue-300);
            padding-left: 4px;
        }

        .footer-bottom {
            padding: 1.5rem 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-bottom p {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.25);
            font-weight: 500;
        }

        .footer-bottom-links {
            display: flex;
            gap: 1.5rem;
        }

        .footer-bottom-links a {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.25);
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .footer-bottom-links a:hover { color: rgba(255,255,255,0.6); }

        /* ═══════════════════════════════
           SCROLL TO TOP
        ═══════════════════════════════ */
        .scroll-top {
            position: fixed;
            bottom: 2rem; right: 2rem;
            width: 46px; height: 46px;
            background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
            border: none;
            border-radius: 13px;
            color: var(--white);
            font-size: 1.1rem;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 25px rgba(37,99,235,0.35);
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            z-index: 500;
        }

        .scroll-top.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-top:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(37,99,235,0.5);
        }

        /* ═══════════════════════════════
           ANIMATIONS
        ═══════════════════════════════ */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ═══════════════════════════════
           RESPONSIVE
        ═══════════════════════════════ */
        @media (max-width: 1024px) {
            .hero h1 { font-size: 3.2rem; }
            .section-title { font-size: 2.3rem; }
            .features-grid { grid-template-columns: repeat(2, 1fr); }
            .steps-grid { grid-template-columns: repeat(2, 1fr); gap: 2rem; }
            .steps-grid::before { display: none; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-grid { grid-template-columns: repeat(2, 1fr); }
            .preview-body { grid-template-columns: 160px 1fr; }
            .preview-stats { grid-template-columns: repeat(2, 1fr); }
            .preview-chart-area { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .nav-hamburger { display: flex; }

            .nav-links.mobile-active {
                display: flex;
                flex-direction: column;
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                background: var(--slate-900);
                justify-content: center;
                align-items: center;
                gap: 0.5rem;
                z-index: 999;
            }

            .nav-links.mobile-active a {
                color: rgba(255,255,255,0.7);
                font-size: 1.2rem;
                padding: 0.8rem 2rem;
            }

            .nav-links.mobile-active a:hover {
                color: var(--white);
                background: rgba(255,255,255,0.08);
            }

            .nav-actions { gap: 0.5rem; }

            .nav-btn-ghost {
                display: none;
            }

            .hero { padding: 8rem 0 4rem; }
            .hero h1 { font-size: 2.5rem; }
            .hero-desc { font-size: 1rem; }

            .preview-body { display: none; }
            .preview-topbar { justify-content: center; }
            .hero-preview-window {
                transform: none;
                min-height: 60px;
            }

            .features-grid { grid-template-columns: 1fr; }
            .steps-grid { grid-template-columns: 1fr; gap: 1.5rem; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
            .stat-value { font-size: 2.2rem; }

            .cta-wrapper { padding: 3rem 1.5rem; border-radius: 20px; }
            .cta-content h2 { font-size: 1.7rem; }

            .footer-grid { grid-template-columns: 1fr; text-align: center; gap: 2rem; }
            .footer-socials { justify-content: center; }
            .footer-bottom { justify-content: center; text-align: center; }
            .footer-bottom-links { justify-content: center; }
        }

        @media (max-width: 480px) {
            .hero h1 { font-size: 2rem; }
            .hero-buttons { flex-direction: column; align-items: center; }
            .btn { width: 100%; justify-content: center; }
            .section-title { font-size: 1.8rem; }
            .stats-grid { grid-template-columns: 1fr; }
            .stat-card { padding: 1rem; }
            .clients-logos { gap: 2rem; }
            .client-logo { font-size: 1rem; }
        }
    </style>
</head>
<body>

    <!-- ════════ NAVBAR ════════ -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="/" class="nav-logo">
                <div class="nav-logo-icon">
                    <i class="bi bi-boxes"></i>
                </div>
                <span class="nav-logo-text">Sofrebak</span>
            </a>

            <div class="nav-links" id="navLinks">
                <a href="#features">Fonctionnalités</a>
                <a href="#how">Comment ça marche</a>
                <a href="#stats">Statistiques</a>
                <a href="#contact">Contact</a>
            </div>

            <div class="nav-actions">
                @auth
                    <a href="/dashboard" class="nav-btn nav-btn-primary">
                        <i class="bi bi-grid-1x2-fill"></i> Dashboard
                    </a>
                @else
                    <a href="/login" class="nav-btn nav-btn-ghost">Se connecter</a>
                    <a href="/register" class="nav-btn nav-btn-primary">
                        Commencer <i class="bi bi-arrow-right"></i>
                    </a>
                @endauth
                <button class="nav-hamburger" id="hamburger" onclick="toggleMenu()" aria-label="Menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- ════════ HERO ════════ -->
    <section class="hero" id="hero">
        <div class="hero-grid"></div>
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="hero-orb hero-orb-3"></div>

        <div class="container">
            <div class="hero-content fade-up">
                <div class="hero-badge">
                    <span class="dot"></span>
                    Plateforme de gestion #1 au Maroc
                </div>

                <h1>
                    Gérez votre entreprise<br>
                    <span class="gradient-text">en toute simplicité</span>
                </h1>

                <p class="hero-desc">
                    Commandes, stock, factures et clients — tout centralisé dans une plateforme
                    intelligente conçue pour les entreprises de matériaux de construction.
                </p>

                <div class="hero-buttons">
                    @auth
                        <a href="/dashboard" class="btn btn-primary">
                            <i class="bi bi-grid-1x2-fill"></i> Accéder au Dashboard
                        </a>
                    @else
                        <a href="/register" class="btn btn-primary">
                            Créer un compte gratuit <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="#features" class="btn btn-outline-light">
                            <i class="bi bi-play-circle"></i> Découvrir
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Dashboard Preview -->
            <div class="hero-preview fade-up" style="transition-delay: 0.3s;">
                <div class="hero-preview-window">
                    <div class="preview-topbar">
                        <span class="preview-dot preview-dot-red"></span>
                        <span class="preview-dot preview-dot-yellow"></span>
                        <span class="preview-dot preview-dot-green"></span>
                        <span class="preview-url">sofrebak.com/dashboard</span>
                    </div>
                    <div class="preview-body">
                        <div class="preview-sidebar">
                            <div class="preview-sidebar-logo">
                                <div class="preview-sidebar-logo-box">
                                    <i class="bi bi-boxes"></i>
                                </div>
                                <span>Sofrebak</span>
                            </div>
                            <div class="preview-nav-item active">
                                <i class="bi bi-grid-1x2-fill"></i> Dashboard
                            </div>
                            <div class="preview-nav-item">
                                <i class="bi bi-bag-plus-fill"></i> Commandes
                            </div>
                            <div class="preview-nav-item">
                                <i class="bi bi-clipboard2-data-fill"></i> Stock
                            </div>
                            <div class="preview-nav-item">
                                <i class="bi bi-people-fill"></i> Clients
                            </div>
                            <div class="preview-nav-item">
                                <i class="bi bi-receipt-cutoff"></i> Factures
                            </div>
                            <div class="preview-nav-item">
                                <i class="bi bi-box-seam-fill"></i> Produits
                            </div>
                        </div>
                        <div class="preview-main">
                            <div class="preview-stats">
                                <div class="preview-stat-card">
                                    <div class="preview-stat-label">Commandes</div>
                                    <div class="preview-stat-value">1,247</div>
                                    <div class="preview-stat-change up">↑ 12.5%</div>
                                </div>
                                <div class="preview-stat-card">
                                    <div class="preview-stat-label">Chiffre d'affaires</div>
                                    <div class="preview-stat-value">845K</div>
                                    <div class="preview-stat-change up">↑ 8.3%</div>
                                </div>
                                <div class="preview-stat-card">
                                    <div class="preview-stat-label">Clients</div>
                                    <div class="preview-stat-value">326</div>
                                    <div class="preview-stat-change up">↑ 5.1%</div>
                                </div>
                                <div class="preview-stat-card">
                                    <div class="preview-stat-label">Produits</div>
                                    <div class="preview-stat-value">2,180</div>
                                    <div class="preview-stat-change up">↑ 3.7%</div>
                                </div>
                            </div>
                            <div class="preview-chart-area">
                                <div class="preview-chart-box">
                                    <div class="preview-chart-title">Revenus mensuels</div>
                                    <div class="preview-chart-bars">
                                        <div class="preview-bar" style="height: 45%;"></div>
                                        <div class="preview-bar" style="height: 65%;"></div>
                                        <div class="preview-bar" style="height: 50%;"></div>
                                        <div class="preview-bar" style="height: 80%;"></div>
                                        <div class="preview-bar" style="height: 60%;"></div>
                                        <div class="preview-bar" style="height: 90%;"></div>
                                        <div class="preview-bar" style="height: 75%;"></div>
                                        <div class="preview-bar" style="height: 85%;"></div>
                                        <div class="preview-bar" style="height: 70%;"></div>
                                        <div class="preview-bar" style="height: 95%;"></div>
                                        <div class="preview-bar" style="height: 82%;"></div>
                                        <div class="preview-bar" style="height: 100%;"></div>
                                    </div>
                                </div>
                                <div class="preview-chart-box">
                                    <div class="preview-chart-title">Dernières commandes</div>
                                    <div class="preview-list-item">
                                        <span class="preview-list-dot" style="background: var(--green-500);"></span>
                                        <span class="preview-list-text">CMD-1247</span>
                                        <span class="preview-list-value">12,500 DH</span>
                                    </div>
                                    <div class="preview-list-item">
                                        <span class="preview-list-dot" style="background: var(--blue-400);"></span>
                                        <span class="preview-list-text">CMD-1246</span>
                                        <span class="preview-list-value">8,320 DH</span>
                                    </div>
                                    <div class="preview-list-item">
                                        <span class="preview-list-dot" style="background: var(--amber-500);"></span>
                                        <span class="preview-list-text">CMD-1245</span>
                                        <span class="preview-list-value">15,750 DH</span>
                                    </div>
                                    <div class="preview-list-item">
                                        <span class="preview-list-dot" style="background: var(--green-500);"></span>
                                        <span class="preview-list-text">CMD-1244</span>
                                        <span class="preview-list-value">6,900 DH</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════ CLIENTS BAR ════════ -->
    <section class="clients">
        <div class="container">
            <div class="clients-label">Fait confiance par les leaders du secteur</div>
            <div class="clients-logos">
                <span class="client-logo">Ciment du Maroc</span>
                <span class="client-logo">LafargeHolcim</span>
                <span class="client-logo">SONASID</span>
                <span class="client-logo">Super Cérame</span>
                <span class="client-logo">Médi1</span>
            </div>
        </div>
    </section>

    <!-- ════════ FEATURES ════════ -->
    <section class="features" id="features">
        <div class="container">
            <div class="features-header">
                <div class="section-label">
                    <i class="bi bi-lightning-charge-fill"></i>
                    Fonctionnalités
                </div>
                <h2 class="section-title">Tout ce dont vous avez besoin</h2>
                <p class="section-desc">
                    Une suite complète d'outils de gestion pour piloter votre activité
                    de matériaux de construction de A à Z.
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-card fade-up">
                    <div class="feature-icon blue">
                        <i class="bi bi-bag-plus-fill"></i>
                    </div>
                    <h3 class="feature-title">Gestion des Commandes</h3>
                    <p class="feature-desc">
                        Créez, suivez et gérez toutes vos commandes clients avec un tableau de bord intuitif et des notifications en temps réel.
                    </p>
                </div>

                <div class="feature-card fade-up" style="transition-delay: 0.1s;">
                    <div class="feature-icon green">
                        <i class="bi bi-clipboard2-data-fill"></i>
                    </div>
                    <h3 class="feature-title">Suivi du Stock</h3>
                    <p class="feature-desc">
                        Surveillez vos niveaux de stock en temps réel, recevez des alertes automatiques et optimisez votre approvisionnement.
                    </p>
                </div>

                <div class="feature-card fade-up" style="transition-delay: 0.2s;">
                    <div class="feature-icon amber">
                        <i class="bi bi-receipt-cutoff"></i>
                    </div>
                    <h3 class="feature-title">Facturation Rapide</h3>
                    <p class="feature-desc">
                        Générez des factures professionnelles en quelques clics, suivez les paiements et gérez votre trésorerie efficacement.
                    </p>
                </div>

                <div class="feature-card fade-up" style="transition-delay: 0.3s;">
                    <div class="feature-icon purple">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3 class="feature-title">Base Clients</h3>
                    <p class="feature-desc">
                        Centralisez toutes les informations de vos clients, historique des commandes et préférences pour un service personnalisé.
                    </p>
                </div>

                <div class="feature-card fade-up" style="transition-delay: 0.4s;">
                    <div class="feature-icon red">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>
                    <h3 class="feature-title">Catalogue Produits</h3>
                    <p class="feature-desc">
                        Organisez vos produits par catégories, gérez les prix et les descriptions avec un système de recherche avancé.
                    </p>
                </div>

                <div class="feature-card fade-up" style="transition-delay: 0.5s;">
                    <div class="feature-icon cyan">
                        <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <h3 class="feature-title">Gestion Fournisseurs</h3>
                    <p class="feature-desc">
                        Gérez vos relations fournisseurs, comparez les prix et optimisez vos achats pour maximiser vos marges.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════ HOW IT WORKS ════════ -->
    <section class="how-it-works" id="how">
        <div class="container">
            <div class="how-header">
                <div class="section-label">
                    <i class="bi bi-rocket-takeoff-fill"></i>
                    Comment ça marche
                </div>
                <h2 class="section-title">Commencez en 4 étapes simples</h2>
                <p class="section-desc">
                    De l'inscription à la gestion complète de votre entreprise, tout est conçu pour être simple et rapide.
                </p>
            </div>

            <div class="steps-grid">
                <div class="step-card fade-up">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Créez votre compte</h3>
                    <p class="step-desc">Inscription rapide et gratuite en moins de 30 secondes. Aucune carte bancaire requise.</p>
                </div>
                <div class="step-card fade-up" style="transition-delay: 0.15s;">
                    <div class="step-number">2</div>
                    <h3 class="step-title">Configurez vos données</h3>
                    <p class="step-desc">Importez vos produits, clients et fournisseurs ou commencez de zéro.</p>
                </div>
                <div class="step-card fade-up" style="transition-delay: 0.3s;">
                    <div class="step-number">3</div>
                    <h3 class="step-title">Gérez vos opérations</h3>
                    <p class="step-desc">Créez des commandes, suivez le stock et générez des factures en quelques clics.</p>
                </div>
                <div class="step-card fade-up" style="transition-delay: 0.45s;">
                    <div class="step-number">4</div>
                    <h3 class="step-title">Analysez et optimisez</h3>
                    <p class="step-desc">Consultez vos tableaux de bord et améliorez la performance de votre entreprise.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════ STATS ════════ -->
    <section class="stats" id="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card fade-up">
                    <div class="stat-value">500<span>+</span></div>
                    <div class="stat-label">Entreprises actives</div>
                </div>
                <div class="stat-card fade-up" style="transition-delay: 0.1s;">
                    <div class="stat-value">50K<span>+</span></div>
                    <div class="stat-label">Commandes traitées</div>
                </div>
                <div class="stat-card fade-up" style="transition-delay: 0.2s;">
                    <div class="stat-value">99.9<span>%</span></div>
                    <div class="stat-label">Disponibilité</div>
                </div>
                <div class="stat-card fade-up" style="transition-delay: 0.3s;">
                    <div class="stat-value">24<span>/7</span></div>
                    <div class="stat-label">Support technique</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════ CTA ════════ -->
    <section class="cta" id="contact">
        <div class="container">
            <div class="cta-wrapper fade-up">
                <div class="cta-content">
                    <h2>Prêt à transformer votre gestion ?</h2>
                    <p>Rejoignez des centaines d'entreprises qui utilisent Sofrebak pour optimiser leurs opérations au quotidien.</p>
                    @auth
                        <a href="/dashboard" class="btn btn-white">
                            <i class="bi bi-grid-1x2-fill"></i> Accéder au Dashboard
                        </a>
                    @else
                        <a href="/register" class="btn btn-white">
                            Créer un compte gratuit <i class="bi bi-arrow-right"></i>
                        </a>
                    @endauth
                    <div class="cta-note">
                        <i class="bi bi-shield-check"></i> Inscription gratuite — Aucune carte bancaire requise
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════ FOOTER ════════ -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-brand-text">
                        <div class="footer-brand-icon">
                            <i class="bi bi-boxes"></i>
                        </div>
                        <span class="footer-brand-name">Sofrebak</span>
                    </div>
                    <p>La plateforme de gestion tout-en-un pour les entreprises de matériaux de construction au Maroc.</p>
                    <div class="footer-socials">
                        <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Plateforme</h4>
                    <ul>
                        <li><a href="#features">Fonctionnalités</a></li>
                        <li><a href="#how">Comment ça marche</a></li>
                        <li><a href="#stats">Statistiques</a></li>
                        <li><a href="/login">Se connecter</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Gestion</h4>
                    <ul>
                        <li><a href="/commandes">Commandes</a></li>
                        <li><a href="/clients">Clients</a></li>
                        <li><a href="/produits">Produits</a></li>
                        <li><a href="/factures">Factures</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Contact</h4>
                    <ul>
                        <li><a href="#">contact@sofrebak.com</a></li>
                        <li><a href="#">+212 5XX-XXXXXX</a></li>
                        <li><a href="#">Casablanca, Maroc</a></li>
                        <li><a href="#">Lun — Sam: 9h — 19h</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Sofrebak. Tous droits réservés.</p>
                <div class="footer-bottom-links">
                    <a href="#">Confidentialité</a>
                    <a href="#">Conditions</a>
                    <a href="#">Mentions légales</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- SCROLL TO TOP -->
    <button class="scroll-top" id="scrollTop" onclick="scrollToTop()" aria-label="Scroll to top">
        <i class="bi bi-arrow-up"></i>
    </button>

    <script>
        // ===== MOBILE MENU =====
        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            const hamburger = document.getElementById('hamburger');
            navLinks.classList.toggle('mobile-active');
            hamburger.classList.toggle('active');
        }

        // Close mobile menu on link click
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('navLinks').classList.remove('mobile-active');
                document.getElementById('hamburger').classList.remove('active');
            });
        });

        // ===== SCROLL EVENTS =====
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            const scrollBtn = document.getElementById('scrollTop');

            if (window.scrollY > 80) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            if (window.scrollY > 500) {
                scrollBtn.classList.add('visible');
            } else {
                scrollBtn.classList.remove('visible');
            }
        });

        // ===== FADE UP ON SCROLL =====
        const fadeObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    fadeObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.fade-up').forEach(el => fadeObserver.observe(el));

        // ===== SMOOTH SCROLL =====
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        const offset = 80;
                        const top = target.getBoundingClientRect().top + window.scrollY - offset;
                        window.scrollTo({ top, behavior: 'smooth' });
                    }
                }
            });
        });
    </script>
</body>
</html>