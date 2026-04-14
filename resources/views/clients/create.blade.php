@extends('_layout')

@section('title', 'Ajouter un Client - Sofrebak')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        :root {
            --bg-page: #f5f6fa;
            --bg-white: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --accent: #6366f1;
            --accent-2: #8b5cf6;
            --accent-3: #06b6d4;
            --green: #10b981;
            --orange: #f59e0b;
            --red: #ef4444;
            --pink: #ec4899;
            --border: #e2e8f0;
            --input-bg: #f8fafc;
            --input-focus: #eef2ff;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.08);
            --shadow-xl: 0 25px 60px rgba(0, 0, 0, 0.1);
            --radius-sm: 12px;
            --radius-md: 16px;
            --radius-lg: 24px;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        /* ═══════════════════════════════
                                       HERO HEADER
                                    ═══════════════════════════════ */
        .create-hero {
            background: linear-gradient(160deg, #0f172a 0%, #1e293b 35%, #1e3a5f 65%, #0e7490 100%);
            padding: 2rem 0 5rem;
            position: relative;
            overflow: hidden;
        }

        .create-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 500px 350px at 75% 20%, rgba(6, 182, 212, 0.2), transparent),
                radial-gradient(ellipse 350px 250px at 25% 75%, rgba(99, 102, 241, 0.12), transparent),
                radial-gradient(ellipse 250px 250px at 50% 50%, rgba(16, 185, 129, 0.08), transparent);
        }

        .create-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle 1px at 15% 25%, rgba(255, 255, 255, 0.12), transparent),
                radial-gradient(circle 1px at 35% 65%, rgba(255, 255, 255, 0.08), transparent),
                radial-gradient(circle 1px at 55% 15%, rgba(255, 255, 255, 0.1), transparent),
                radial-gradient(circle 1px at 75% 55%, rgba(255, 255, 255, 0.06), transparent),
                radial-gradient(circle 1px at 85% 35%, rgba(255, 255, 255, 0.1), transparent);
        }

        /* Animated Orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            animation: orbDrift 10s ease-in-out infinite;
            z-index: 0;
        }

        .orb-1 {
            width: 280px;
            height: 280px;
            background: rgba(6, 182, 212, 0.12);
            top: -80px;
            right: -40px;
        }

        .orb-2 {
            width: 180px;
            height: 180px;
            background: rgba(16, 185, 129, 0.08);
            bottom: -40px;
            left: 15%;
            animation-delay: 4s;
        }

        .orb-3 {
            width: 120px;
            height: 120px;
            background: rgba(99, 102, 241, 0.1);
            top: 30%;
            left: 55%;
            animation-delay: 7s;
        }

        @keyframes orbDrift {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(15px, -15px) scale(1.04);
            }

            66% {
                transform: translate(-10px, 10px) scale(0.96);
            }
        }

        /* Glass Buttons */
        .btn-glass {
            background: rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: rgba(255, 255, 255, 0.85);
            border-radius: var(--radius-sm);
            padding: 0.5rem 1.1rem;
            font-size: 0.78rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .btn-glass:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.25);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        /* Breadcrumb */
        .bc-glass {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.76rem;
        }

        .bc-glass a {
            color: rgba(255, 255, 255, 0.45);
            text-decoration: none;
            transition: color 0.3s;
        }

        .bc-glass a:hover {
            color: rgba(255, 255, 255, 0.85);
        }

        .bc-glass .sep {
            color: rgba(255, 255, 255, 0.2);
            font-size: 0.55rem;
        }

        .bc-glass .current {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 600;
        }

        /* Hero Content */
        .hero-inner {
            position: relative;
            z-index: 10;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            background: linear-gradient(135deg, rgba(6, 182, 212, 0.25), rgba(16, 185, 129, 0.25));
            border: 1px solid rgba(6, 182, 212, 0.3);
            color: #a5f3fc;
            border-radius: 50px;
            padding: 0.25rem 0.8rem;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .hero-title {
            font-size: 2rem;
            font-weight: 900;
            background: linear-gradient(135deg, #fff, rgba(255, 255, 255, 0.8));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
            margin: 0.6rem 0 0.25rem;
        }

        .hero-sub {
            color: rgba(255, 255, 255, 0.45);
            font-size: 0.82rem;
            font-weight: 400;
        }

        .hero-sub strong {
            color: rgba(255, 255, 255, 0.65);
        }

        /* ═══════════════════════════════
                                       FORM AREA
                                    ═══════════════════════════════ */
        .form-area {
            margin-top: -3rem;
            padding-bottom: 3rem;
            position: relative;
            z-index: 20;
        }

        .form-card {
            background: var(--bg-white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .form-section {
            padding: 1.75rem 2rem;
            border-bottom: 1px solid var(--border);
        }

        .form-section:last-of-type {
            border-bottom: none;
        }

        .section-label {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            margin-bottom: 1.5rem;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .section-icon.cyan {
            background: linear-gradient(135deg, #ecfeff, #cffafe);
            color: #0891b2;
        }

        .section-icon.green {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            color: #059669;
        }

        .section-icon.purple {
            background: linear-gradient(135deg, #f5f3ff, #ede9fe);
            color: #7c3aed;
        }

        .section-icon.orange {
            background: linear-gradient(135deg, #fffbeb, #fef3c7);
            color: #d97706;
        }

        .section-title {
            font-size: 0.82rem;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.2px;
            margin-bottom: 0.15rem;
        }

        .section-desc {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-bottom: 0;
        }

        /* Fields */
        .field-group {
            margin-bottom: 0.25rem;
        }

        .field-label {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .field-label i {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .required {
            color: var(--red);
            font-weight: 700;
        }

        .custom-input,
        .custom-select,
        .custom-textarea {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 0.82rem;
            color: var(--text-primary);
            background: var(--input-bg);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
        }

        .custom-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .custom-input:focus,
        .custom-select:focus,
        .custom-textarea:focus {
            border-color: var(--accent);
            background: var(--input-focus);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08);
        }

        .custom-input.is-invalid,
        .custom-select.is-invalid,
        .custom-textarea.is-invalid {
            border-color: var(--red);
            background: #fef2f2;
        }

        .custom-input.is-invalid:focus,
        .custom-select.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.08);
        }

        .custom-input::placeholder {
            color: var(--text-muted);
            font-weight: 400;
        }

        .custom-textarea::placeholder {
            color: var(--text-muted);
            font-weight: 400;
        }

        .input-icon-wrap {
            position: relative;
        }

        .input-icon-wrap .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.85rem;
            transition: color 0.3s;
            pointer-events: none;
        }

        .input-icon-wrap .custom-input {
            padding-left: 2.75rem;
        }

        .input-icon-wrap:focus-within .input-icon {
            color: var(--accent);
        }

        .input-suffix-wrap {
            position: relative;
        }

        .input-suffix-wrap .custom-input {
            padding-right: 3.5rem;
        }

        .input-suffix {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--text-muted);
            pointer-events: none;
        }

        .field-hint {
            font-size: 0.68rem;
            color: var(--text-muted);
            margin-top: 0.4rem;
            padding-left: 0.15rem;
        }

        .error-text {
            font-size: 0.7rem;
            color: var(--red);
            margin-top: 0.35rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-weight: 500;
        }

        /* ═══════════════════════════════
                                       FOOTER ACTIONS
                                    ═══════════════════════════════ */
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            background: linear-gradient(180deg, #f8fafc, #f1f5f9);
            border-top: 1px solid var(--border);
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.6rem 1.25rem;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-secondary);
            background: var(--bg-white);
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-cancel:hover {
            border-color: var(--red);
            color: var(--red);
            background: #fef2f2;
        }

        .btn-reset {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.6rem 1.25rem;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-secondary);
            background: var(--bg-white);
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-reset:hover {
            border-color: var(--orange);
            color: var(--orange);
            background: #fffbeb;
        }

        .btn-submit {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.75rem;
            background: linear-gradient(135deg, #0f172a, #1e3a5f, #0e7490);
            color: #fff;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(14, 116, 144, 0.35);
        }

        .btn-shine {
            position: absolute;
            top: 0;
            left: -100%;
            width: 60%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transform: skewX(-25deg);
            animation: shineLoop 4s ease-in-out infinite;
        }

        @keyframes shineLoop {

            0%,
            70%,
            100% {
                left: -100%;
            }

            90% {
                left: 150%;
            }
        }

        /* ═══════════════════════════════
                                       SIDEBAR SUMMARY
                                    ═══════════════════════════════ */
        .summary-card {
            background: var(--bg-white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
            overflow: hidden;
            position: sticky;
            top: 1.5rem;
        }

        .summary-header {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 1.25rem 1.5rem;
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-bottom: 1px solid var(--border);
        }

        .summary-header-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--accent-3), var(--green));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 0.85rem;
        }

        .summary-header h6 {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }

        .summary-body {
            padding: 1.25rem 1.5rem;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.55rem 0;
        }

        .summary-item-label {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.72rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .summary-item-label i {
            font-size: 0.7rem;
        }

        .summary-item-value {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .summary-divider {
            height: 1px;
            background: var(--border);
            margin: 0.25rem 0;
        }

        .summary-empty {
            text-align: center;
            padding: 1rem 0;
            color: var(--text-muted);
            font-size: 0.75rem;
        }

        .summary-empty i {
            font-size: 1.6rem;
            display: block;
            margin-bottom: 0.5rem;
            opacity: 0.4;
        }

        /* Tips Card */
        .tips-card {
            background: linear-gradient(135deg, #ecfeff, #cffafe);
            border: 1px solid #a5f3fc;
            border-radius: var(--radius-md);
            padding: 1.25rem;
            margin-top: 1rem;
        }

        .tips-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
        }

        .tips-header span:first-child {
            font-size: 1rem;
        }

        .tips-title {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #155e75;
        }

        .tips-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .tips-list li {
            font-size: 0.72rem;
            color: #155e75;
            padding: 0.3rem 0;
            display: flex;
            align-items: flex-start;
            gap: 0.4rem;
            font-weight: 500;
        }

        .tips-list li i {
            color: #0891b2;
            font-size: 0.6rem;
            margin-top: 0.2rem;
            flex-shrink: 0;
        }

        /* ═══════════════════════════════
                                       ANIMATIONS
                                    ═══════════════════════════════ */
        .anim-up {
            opacity: 0;
            transform: translateY(25px);
            animation: animUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes animUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .delay-1 {
            animation-delay: 0.05s;
        }

        .delay-2 {
            animation-delay: 0.1s;
        }

        .delay-3 {
            animation-delay: 0.15s;
        }

        .delay-4 {
            animation-delay: 0.2s;
        }

        .delay-5 {
            animation-delay: 0.25s;
        }

        .delay-6 {
            animation-delay: 0.3s;
        }

        /* ═══════════════════════════════
                                       RESPONSIVE
                                    ═══════════════════════════════ */
        @media (max-width: 992px) {
            .summary-card {
                position: static;
                margin-top: 1rem;
            }

            .hero-title {
                font-size: 1.6rem;
            }

            .form-section {
                padding: 1.25rem 1.25rem;
            }

            .form-footer {
                padding: 1.25rem;
                flex-wrap: wrap;
                gap: 0.75rem;
            }
        }

        @media (max-width: 576px) {
            .create-hero {
                padding: 1.5rem 0 4rem;
            }

            .hero-title {
                font-size: 1.35rem;
            }

            .form-footer {
                flex-direction: column;
            }

            .form-footer>* {
                width: 100%;
                text-align: center;
                justify-content: center;
            }
        }
    </style>

    <!-- ═══════════ HERO ═══════════ -->
    <div class="create-hero">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="hero-inner">

                        <!-- Nav -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <a href="{{ route('clients.index') }}" class="btn-glass">
                                    <i class="bi bi-arrow-left-short" style="font-size:1.1rem;"></i>
                                    Retour
                                </a>
                                <div class="bc-glass d-none d-md-flex">
                                    <a href="{{ route('clients.index') }}"><i class="bi bi-house-fill"></i></a>
                                    <span class="sep"><i class="bi bi-chevron-right"></i></span>
                                    <a href="{{ route('clients.index') }}">Clients</a>
                                    <span class="sep"><i class="bi bi-chevron-right"></i></span>
                                    <span class="current">Nouveau Client</span>
                                </div>
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="anim-up delay-1">
                            <span class="hero-badge">
                                <i class="bi bi-person-plus-fill"></i>
                                Création
                            </span>
                        </div>
                        <div class="anim-up delay-2">
                            <h1 class="hero-title">Nouveau Client</h1>
                            <p class="hero-sub">
                                Remplissez les informations ci-dessous pour ajouter un <strong>nouveau client</strong> au
                                système
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ═══════════ FORM ═══════════ -->
    <div class="form-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row g-4">

                        <!-- Left: Form -->
                        <div class="col-lg-8 anim-up delay-3">
                            <form action="{{ route('clients.store') }}" method="POST" id="createClientForm">
                                @csrf

                                <div class="form-card">

                                    <!-- Section 1: Contact Information -->
                                    <div class="form-section">
                                        <div class="section-label">
                                            <div class="section-icon cyan">
                                                <i class="bi bi-person-badge-fill"></i>
                                            </div>
                                            <div>
                                                <h6 class="section-title">Informations du contact</h6>
                                                <p class="section-desc">Personne de contact et coordonnées principales</p>
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <!-- Personne Contact -->
                                            <div class="col-md-6">
                                                <div class="field-group">
                                                    <label class="field-label">
                                                        <i class="bi bi-person-fill"></i>
                                                        Nom du contact
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="input-icon-wrap">
                                                        <i class="bi bi-person input-icon"></i>
                                                        <input type="text" name="personne_contact" id="personne_contact"
                                                            value="{{ old('personne_contact') }}" placeholder="Nom complet"
                                                            class="custom-input @error('personne_contact') is-invalid @enderror"
                                                            required>
                                                    </div>
                                                    @error('personne_contact')
                                                        <div class="error-text"><i
                                                                class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Telephone -->
                                            <div class="col-md-6">
                                                <div class="field-group">
                                                    <label class="field-label">
                                                        <i class="bi bi-telephone-fill"></i>
                                                        Téléphone
                                                    </label>
                                                    <div class="input-icon-wrap">
                                                        <i class="bi bi-telephone input-icon"></i>
                                                        <input type="text" name="telephone" id="telephone"
                                                            value="{{ old('telephone') }}" placeholder="+212 6XX XXX XXX"
                                                            maxlength="14"
                                                            class="custom-input @error('telephone') is-invalid @enderror">
                                                    </div>
                                                    <div class="field-hint">Format: +212 6123456789</div>
                                                    @error('telephone')
                                                        <div class="error-text"><i
                                                                class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6">
                                                <div class="field-group">
                                                    <label class="field-label">
                                                        <i class="bi bi-envelope-fill"></i>
                                                        Email
                                                    </label>
                                                    <div class="input-icon-wrap">
                                                        <i class="bi bi-envelope input-icon"></i>
                                                        <input type="email" name="email" id="email"
                                                            value="{{ old('email') }}" placeholder="client@exemple.com"
                                                            class="custom-input @error('email') is-invalid @enderror">
                                                    </div>
                                                    @error('email')
                                                        <div class="error-text"><i
                                                                class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Région -->
                                            <div class="col-md-6">
                                                <div class="field-group">
                                                    <label class="field-label">
                                                        <i class="bi bi-geo-alt-fill"></i>
                                                        Région
                                                    </label>
                                                    <select name="region_id" id="region_id"
                                                        class="custom-select @error('region_id') is-invalid @enderror">
                                                        <option value="">Sélectionner une région...</option>
                                                        @foreach ($region as $rg)
                                                            <option value="{{ $rg->id }}" {{ old('region_id') == $rg->id ? 'selected' : '' }}>
                                                                {{ $rg->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('region_id')
                                                        <div class="error-text"><i
                                                                class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 2: Entreprise -->
                                    <div class="form-section">
                                        <div class="section-label">
                                            <div class="section-icon green">
                                                <i class="bi bi-building"></i>
                                            </div>
                                            <div>
                                                <h6 class="section-title">Entreprise</h6>
                                                <p class="section-desc">Raison sociale et plafond de crédit</p>
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <!-- Nom Entreprise -->
                                            <div class="col-md-6">
                                                <div class="field-group">
                                                    <label class="field-label">
                                                        <i class="bi bi-building"></i>
                                                        Nom de l'entreprise
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="input-icon-wrap">
                                                        <i class="bi bi-building input-icon"></i>
                                                        <input type="text" name="nom_entreprise" id="nom_entreprise"
                                                            value="{{ old('nom_entreprise') }}" placeholder="Raison sociale"
                                                            class="custom-input @error('nom_entreprise') is-invalid @enderror"
                                                            required>
                                                    </div>
                                                    @error('nom_entreprise')
                                                        <div class="error-text"><i
                                                                class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Plafond de Crédit -->
                                            <div class="col-md-6">
                                                <div class="field-group">
                                                    <label class="field-label">
                                                        <i class="bi bi-cash-stack"></i>
                                                        Plafond de crédit
                                                    </label>
                                                    <div class="input-suffix-wrap">
                                                        <input type="number" step="0.01" name="plafond_credit"
                                                            id="plafond_credit" value="{{ old('plafond_credit') }}"
                                                            placeholder="0.00"
                                                            class="custom-input @error('plafond_credit') is-invalid @enderror">
                                                        <span class="input-suffix">DH</span>
                                                    </div>
                                                    <div class="field-hint">Montant maximum de crédit autorisé</div>
                                                    @error('plafond_credit')
                                                        <div class="error-text"><i
                                                                class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 3: Adresse -->
                                    <div class="form-section">
                                        <div class="section-label">
                                            <div class="section-icon orange">
                                                <i class="bi bi-pin-map-fill"></i>
                                            </div>
                                            <div>
                                                <h6 class="section-title">Adresse</h6>
                                                <p class="section-desc">Localisation complète du client</p>
                                            </div>
                                        </div>

                                        <div class="field-group">
                                            <label class="field-label">
                                                <i class="bi bi-geo-alt"></i>
                                                Adresse complète
                                                <span class="required">*</span>
                                            </label>
                                            <textarea name="adresse" id="adresse" rows="3"
                                                placeholder="Ex: 134 lots Bassma, Massira, Fès..."
                                                class="custom-textarea @error('adresse') is-invalid @enderror"
                                                required>{{ old('adresse') }}</textarea>
                                            @error('adresse')
                                                <div class="error-text"><i
                                                        class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Footer Actions -->
                                    <div class="form-footer">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('clients.index') }}" class="btn-cancel">
                                                <i class="bi bi-x-lg"></i>
                                                Annuler
                                            </a>
                                            <button type="reset" class="btn-reset">
                                                <i class="bi bi-arrow-counterclockwise"></i>
                                                Réinitialiser
                                            </button>
                                        </div>
                                        <button type="submit" class="btn-submit">
                                            <span class="btn-shine"></span>
                                            <i class="bi bi-check2-circle"></i>
                                            Créer le Client
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <!-- Right: Sidebar -->
                        <div class="col-lg-4 anim-up delay-4">

                            <!-- Live Summary Card -->
                            <div class="summary-card">
                                <div class="summary-header">
                                    <div class="summary-header-icon">
                                        <i class="bi bi-clipboard-data-fill"></i>
                                    </div>
                                    <h6>Aperçu en direct</h6>
                                </div>
                                <div class="summary-body">
                                    <div class="summary-item">
                                        <span class="summary-item-label">
                                            <i class="bi bi-person-fill"></i> Contact
                                        </span>
                                        <span class="summary-item-value" id="prevContact"
                                            style="color:var(--text-muted); font-style:italic;">—</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-item-label">
                                            <i class="bi bi-building"></i> Entreprise
                                        </span>
                                        <span class="summary-item-value" id="prevEntreprise"
                                            style="color:var(--text-muted); font-style:italic;">—</span>
                                    </div>

                                    <div class="summary-divider"></div>

                                    <div class="summary-item">
                                        <span class="summary-item-label">
                                            <i class="bi bi-telephone-fill"></i> Téléphone
                                        </span>
                                        <span class="summary-item-value" id="prevTelephone"
                                            style="color:var(--text-muted); font-style:italic;">—</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-item-label">
                                            <i class="bi bi-envelope-fill"></i> Email
                                        </span>
                                        <span class="summary-item-value" id="prevEmail"
                                            style="color:var(--text-muted); font-style:italic;">—</span>
                                    </div>

                                    <div class="summary-divider"></div>

                                    <div class="summary-item">
                                        <span class="summary-item-label">
                                            <i class="bi bi-geo-alt-fill"></i> Région
                                        </span>
                                        <span class="summary-item-value" id="prevRegion"
                                            style="color:var(--text-muted); font-style:italic;">—</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-item-label">
                                            <i class="bi bi-cash-stack"></i> Crédit
                                        </span>
                                        <span class="summary-item-value" id="prevCredit" style="color:var(--green);">0.00
                                            DH</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tips -->
                            <div class="tips-card anim-up delay-5">
                                <div class="tips-header">
                                    <span>💡</span>
                                    <span class="tips-title">Conseils</span>
                                </div>
                                <ul class="tips-list">
                                    <li>
                                        <i class="bi bi-check-circle-fill"></i>
                                        Le nom du contact et l'entreprise sont obligatoires
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill"></i>
                                        L'adresse est requise pour la facturation
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill"></i>
                                        Le plafond de crédit définit la limite de paiement différé
                                    </li>
                                    <li>
                                        <i class="bi bi-check-circle-fill"></i>
                                        L'email sera utilisé pour les notifications
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ═══════════ SCRIPTS ═══════════ -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Live preview updates
            const fields = {
                personne_contact: document.getElementById('personne_contact'),
                nom_entreprise: document.getElementById('nom_entreprise'),
                telephone: document.getElementById('telephone'),
                email: document.getElementById('email'),
                region_id: document.getElementById('region_id'),
                plafond_credit: document.getElementById('plafond_credit'),
            };

            const previews = {
                contact: document.getElementById('prevContact'),
                entreprise: document.getElementById('prevEntreprise'),
                telephone: document.getElementById('prevTelephone'),
                email: document.getElementById('prevEmail'),
                region: document.getElementById('prevRegion'),
                credit: document.getElementById('prevCredit'),
            };

            function updatePreview(previewEl, value, fallback) {
                if (value && value.trim() !== '') {
                    previewEl.textContent = value;
                    previewEl.style.color = 'var(--text-primary)';
                    previewEl.style.fontStyle = 'normal';
                } else {
                    previewEl.textContent = fallback || '—';
                    previewEl.style.color = 'var(--text-muted)';
                    previewEl.style.fontStyle = 'italic';
                }
            }

            if (fields.personne_contact) {
                fields.personne_contact.addEventListener('input', function () {
                    updatePreview(previews.contact, this.value);
                });
            }

            if (fields.nom_entreprise) {
                fields.nom_entreprise.addEventListener('input', function () {
                    updatePreview(previews.entreprise, this.value);
                });
            }

            if (fields.telephone) {
                fields.telephone.addEventListener('input', function () {
                    updatePreview(previews.telephone, this.value);
                });
            }

            if (fields.email) {
                fields.email.addEventListener('input', function () {
                    updatePreview(previews.email, this.value);
                });
            }

            if (fields.region_id) {
                fields.region_id.addEventListener('change', function () {
                    const selected = this.options[this.selectedIndex];
                    updatePreview(previews.region, selected && selected.value ? selected.text : '');
                });
            }

            if (fields.plafond_credit) {
                fields.plafond_credit.addEventListener('input', function () {
                    const val = parseFloat(this.value) || 0;
                    previews.credit.textContent = val.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' DH';
                    previews.credit.style.color = val > 0 ? 'var(--green)' : 'var(--text-muted)';
                    previews.credit.style.fontStyle = 'normal';
                });
            }

            // Form validation visual feedback
            const form = document.getElementById('createClientForm');
            const inputs = form.querySelectorAll('.custom-input, .custom-select, .custom-textarea');

            inputs.forEach(input => {
                input.addEventListener('blur', function () {
                    if (this.value.trim() === '' && this.hasAttribute('required')) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });

                input.addEventListener('input', function () {
                    this.classList.remove('is-invalid');
                });
            });
        });
    </script>
@endsection