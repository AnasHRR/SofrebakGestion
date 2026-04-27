@extends('_layout')

@section('title', 'Modifier le Produit')

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
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.04);
        --shadow-md: 0 4px 20px rgba(0,0,0,0.06);
        --shadow-lg: 0 10px 40px rgba(0,0,0,0.08);
        --shadow-xl: 0 25px 60px rgba(0,0,0,0.1);
        --radius-sm: 12px;
        --radius-md: 16px;
        --radius-lg: 24px;
    }

    * { font-family: 'Inter', sans-serif; }
    body { background: var(--bg-page); }

    /* ═══════════════════════════════
       HERO HEADER
    ═══════════════════════════════ */
    .edit-hero {
        background: linear-gradient(160deg, #0f172a 0%, #1e1b4b 35%, #312e81 65%, #4338ca 100%);
        padding: 2rem 0 5rem;
        position: relative;
        overflow: hidden;
    }

    .edit-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 500px 350px at 75% 20%, rgba(99,102,241,0.2), transparent),
            radial-gradient(ellipse 350px 250px at 25% 75%, rgba(139,92,246,0.15), transparent),
            radial-gradient(ellipse 250px 250px at 50% 50%, rgba(6,182,212,0.08), transparent);
    }

    .edit-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(circle 1px at 15% 25%, rgba(255,255,255,0.12), transparent),
            radial-gradient(circle 1px at 35% 65%, rgba(255,255,255,0.08), transparent),
            radial-gradient(circle 1px at 55% 15%, rgba(255,255,255,0.1), transparent),
            radial-gradient(circle 1px at 75% 55%, rgba(255,255,255,0.06), transparent),
            radial-gradient(circle 1px at 85% 35%, rgba(255,255,255,0.1), transparent),
            radial-gradient(circle 2px at 45% 85%, rgba(255,255,255,0.05), transparent);
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
        width: 280px; height: 280px;
        background: rgba(99,102,241,0.12);
        top: -80px; right: -40px;
    }

    .orb-2 {
        width: 180px; height: 180px;
        background: rgba(236,72,153,0.08);
        bottom: -40px; left: 15%;
        animation-delay: 4s;
    }

    .orb-3 {
        width: 120px; height: 120px;
        background: rgba(6,182,212,0.1);
        top: 30%; left: 55%;
        animation-delay: 7s;
    }

    @keyframes orbDrift {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(15px, -15px) scale(1.04); }
        66% { transform: translate(-10px, 10px) scale(0.96); }
    }

    /* Glass Buttons */
    .btn-glass {
        background: rgba(255,255,255,0.07);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.12);
        color: rgba(255,255,255,0.85);
        border-radius: var(--radius-sm);
        padding: 0.5rem 1.1rem;
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        cursor: pointer;
    }

    .btn-glass:hover {
        background: rgba(255,255,255,0.15);
        border-color: rgba(255,255,255,0.25);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }

    /* Breadcrumb */
    .bc-glass {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.76rem;
    }

    .bc-glass a {
        color: rgba(255,255,255,0.45);
        text-decoration: none;
        transition: color 0.3s;
    }

    .bc-glass a:hover { color: rgba(255,255,255,0.85); }

    .bc-glass .sep {
        color: rgba(255,255,255,0.2);
        font-size: 0.55rem;
    }

    .bc-glass .current {
        color: rgba(255,255,255,0.8);
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
        background: linear-gradient(135deg, rgba(99,102,241,0.25), rgba(139,92,246,0.25));
        border: 1px solid rgba(99,102,241,0.3);
        color: #c7d2fe;
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
        background: linear-gradient(135deg, #fff, rgba(255,255,255,0.8));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -0.5px;
        margin: 0.6rem 0 0.25rem;
    }

    .hero-sub {
        color: rgba(255,255,255,0.45);
        font-size: 0.82rem;
        font-weight: 400;
    }

    .hero-sub strong {
        color: rgba(255,255,255,0.65);
    }

    /* Current Info Pills */
    .info-pills {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-top: 1rem;
    }

    .info-pill {
        background: rgba(255,255,255,0.06);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 50px;
        padding: 0.35rem 0.85rem;
        color: rgba(255,255,255,0.75);
        font-size: 0.7rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .info-pill i { opacity: 0.6; font-size: 0.65rem; }

    /* ═══════════════════════════════
       FORM AREA
    ═══════════════════════════════ */
    .form-area {
        margin-top: -3rem;
        position: relative;
        z-index: 20;
        padding-bottom: 2rem;
    }

    .form-card {
        background: var(--bg-white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
    }

    /* Section Blocks */
    .form-section {
        padding: 1.75rem 2rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .form-section:last-child {
        border-bottom: none;
    }

    .section-label {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        margin-bottom: 1.35rem;
    }

    .section-icon {
        width: 38px;
        height: 38px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        flex-shrink: 0;
    }

    .section-icon.purple {
        background: linear-gradient(135deg, #eef2ff, #e0e7ff);
        color: #6366f1;
    }

    .section-icon.green {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        color: #10b981;
    }

    .section-icon.blue {
        background: linear-gradient(135deg, #ecfeff, #cffafe);
        color: #06b6d4;
    }

    .section-icon.orange {
        background: linear-gradient(135deg, #fff7ed, #fed7aa);
        color: #ea580c;
    }

    .section-title {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--text-secondary);
        margin: 0;
    }

    .section-desc {
        font-size: 0.68rem;
        color: var(--text-muted);
        margin: 0.1rem 0 0;
        font-weight: 400;
    }

    /* Form Controls */
    .field-group {
        margin-bottom: 1.25rem;
    }

    .field-group:last-child {
        margin-bottom: 0;
    }

    .field-label {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.72rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        letter-spacing: 0.3px;
    }

    .field-label i {
        font-size: 0.7rem;
        color: var(--text-muted);
    }

    .field-label .required {
        color: var(--red);
        font-size: 0.6rem;
    }

    .field-hint {
        font-size: 0.65rem;
        color: var(--text-muted);
        margin-top: 0.35rem;
        font-weight: 400;
    }

    /* Custom Input */
    .custom-input {
        width: 100%;
        padding: 0.7rem 1rem;
        background: var(--input-bg);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--text-primary);
        transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        outline: none;
    }

    .custom-input:hover {
        border-color: #cbd5e1;
        background: #fff;
    }

    .custom-input:focus {
        border-color: var(--accent);
        background: var(--input-focus);
        box-shadow: 0 0 0 4px rgba(99,102,241,0.08);
    }

    .custom-input::placeholder {
        color: var(--text-muted);
        font-weight: 400;
    }

    .custom-input[readonly] {
        background: #f1f5f9;
        color: var(--text-secondary);
        cursor: not-allowed;
        border-style: dashed;
    }

    /* Custom Select */
    .custom-select {
        width: 100%;
        padding: 0.7rem 1rem;
        background: var(--input-bg);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--text-primary);
        transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        outline: none;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        padding-right: 2.5rem;
    }

    .custom-select:hover {
        border-color: #cbd5e1;
        background-color: #fff;
    }

    .custom-select:focus {
        border-color: var(--accent);
        background-color: var(--input-focus);
        box-shadow: 0 0 0 4px rgba(99,102,241,0.08);
    }

    /* Input with Suffix */
    .input-suffix-wrap {
        position: relative;
        display: flex;
        align-items: stretch;
    }

    .input-suffix-wrap .custom-input {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-right: none;
    }

    .input-suffix {
        display: flex;
        align-items: center;
        padding: 0 0.85rem;
        background: linear-gradient(135deg, #1e1b4b, #312e81);
        color: rgba(255,255,255,0.85);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 1px;
        border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        border: 1.5px solid var(--border);
        border-left: none;
        white-space: nowrap;
    }

    /* Input with Icon */
    .input-icon-wrap {
        position: relative;
    }

    .input-icon-wrap .custom-input {
        padding-left: 2.75rem;
    }

    .input-icon-wrap .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 0.9rem;
        transition: color 0.3s;
        z-index: 2;
    }

    .input-icon-wrap:focus-within .input-icon {
        color: var(--accent);
    }

    /* Readonly badge */
    .readonly-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        background: #f1f5f9;
        color: var(--text-muted);
        border-radius: 50px;
        padding: 0.15rem 0.55rem;
        font-size: 0.58rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-left: 0.5rem;
    }

    /* ═══════════════════════════════
       LIVE PREVIEW CARD
    ═══════════════════════════════ */
    .live-preview {
        background: linear-gradient(135deg, #fafaff, #f5f3ff);
        border: 1px solid #e9e5ff;
        border-radius: var(--radius-md);
        padding: 1.25rem;
        margin-top: 0.5rem;
    }

    .preview-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .preview-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--accent);
        animation: previewPulse 2s ease infinite;
    }

    @keyframes previewPulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(0.85); }
    }

    .preview-title {
        font-size: 0.62rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--accent);
    }

    .preview-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 0.75rem;
    }

    .preview-item {
        text-align: center;
        padding: 0.65rem;
        background: var(--bg-white);
        border-radius: var(--radius-sm);
        border: 1px solid #e9e5ff;
    }

    .preview-item-label {
        font-size: 0.55rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--text-muted);
        margin-bottom: 0.2rem;
    }

    .preview-item-value {
        font-size: 1rem;
        font-weight: 800;
        color: var(--text-primary);
    }

    .preview-item-value.green { color: var(--green); }
    .preview-item-value.accent { color: var(--accent); }

    /* ═══════════════════════════════
       ERROR STATES
    ═══════════════════════════════ */
    .custom-input.is-invalid,
    .custom-select.is-invalid {
        border-color: var(--red);
        background: #fef2f2;
    }

    .custom-input.is-invalid:focus,
    .custom-select.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(239,68,68,0.08);
    }

    .error-text {
        font-size: 0.68rem;
        color: var(--red);
        font-weight: 600;
        margin-top: 0.35rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .error-text i { font-size: 0.65rem; }

    /* ═══════════════════════════════
       FOOTER ACTIONS
    ═══════════════════════════════ */
    .form-footer {
        padding: 1.5rem 2rem;
        background: linear-gradient(180deg, #fafbff, #fff);
        border-top: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.6rem 1.5rem;
        background: var(--bg-white);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-secondary);
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        cursor: pointer;
    }

    .btn-cancel:hover {
        background: #fef2f2;
        border-color: #fca5a5;
        color: var(--red);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(239,68,68,0.1);
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 2rem;
        background: linear-gradient(135deg, #4338ca, #6366f1);
        border: none;
        border-radius: var(--radius-sm);
        color: #fff;
        font-size: 0.82rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        box-shadow: 0 4px 15px rgba(99,102,241,0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(99,102,241,0.4);
    }

    .btn-submit:hover::before { opacity: 1; }

    .btn-submit:active {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(99,102,241,0.3);
    }

    .btn-submit .btn-shine {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        animation: btnShine 3s ease-in-out infinite;
    }

    @keyframes btnShine {
        0% { left: -100%; }
        50%, 100% { left: 100%; }
    }

    /* Reset / Draft buttons */
    .btn-outline-light {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.5rem 1rem;
        background: transparent;
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-muted);
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-outline-light:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: var(--text-secondary);
    }

    /* ═══════════════════════════════
       SIDEBAR SUMMARY
    ═══════════════════════════════ */
    .summary-card {
        background: var(--bg-white);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        overflow: hidden;
        position: sticky;
        top: 1.5rem;
    }

    .summary-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        background: linear-gradient(180deg, #fafbff, #fff);
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .summary-header-icon {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: linear-gradient(135deg, #eef2ff, #e0e7ff);
        color: var(--accent);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
    }

    .summary-header h6 {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--text-secondary);
        margin: 0;
    }

    .summary-body {
        padding: 1.25rem 1.5rem;
    }

    .summary-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.7rem 0;
        border-bottom: 1px solid #f8fafc;
    }

    .summary-item:last-child { border-bottom: none; }

    .summary-item-label {
        font-size: 0.68rem;
        font-weight: 600;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .summary-item-label i { font-size: 0.65rem; }

    .summary-item-value {
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .summary-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--border), transparent);
        margin: 0.25rem 0;
    }

    /* Margin preview */
    .margin-preview {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border: 1px solid #a7f3d0;
        border-radius: var(--radius-sm);
        padding: 1rem;
        text-align: center;
        margin-top: 0.75rem;
    }

    .margin-preview-label {
        font-size: 0.58rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #059669;
    }

    .margin-preview-value {
        font-size: 1.5rem;
        font-weight: 900;
        color: #059669;
        line-height: 1.2;
        margin-top: 0.2rem;
    }

    .margin-preview-percent {
        font-size: 0.7rem;
        font-weight: 700;
        color: #10b981;
        margin-top: 0.1rem;
    }

    /* Status indicator */
    .stock-indicator {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.85rem 1rem;
        background: #f8fafc;
        border-radius: var(--radius-sm);
        margin-top: 0.75rem;
    }

    .stock-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        flex-shrink: 0;
        position: relative;
    }

    .stock-dot::before {
        content: '';
        position: absolute;
        inset: -3px;
        border-radius: 50%;
        animation: stockPulse 2s ease infinite;
    }

    .stock-dot.good { background: var(--green); }
    .stock-dot.good::before { background: rgba(16,185,129,0.2); }
    .stock-dot.warn { background: var(--orange); }
    .stock-dot.warn::before { background: rgba(245,158,11,0.2); }
    .stock-dot.bad { background: var(--red); }
    .stock-dot.bad::before { background: rgba(239,68,68,0.2); }

    @keyframes stockPulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.8); opacity: 0; }
    }

    .stock-info {
        flex: 1;
    }

    .stock-info-label {
        font-size: 0.62rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
    }

    .stock-info-text {
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    /* Tips Card */
    .tips-card {
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        border: 1px solid #fde68a;
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

    .tips-header span {
        font-size: 1rem;
    }

    .tips-title {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #92400e;
    }

    .tips-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tips-list li {
        font-size: 0.72rem;
        color: #92400e;
        padding: 0.3rem 0;
        display: flex;
        align-items: flex-start;
        gap: 0.4rem;
        font-weight: 500;
    }

    .tips-list li i {
        color: #d97706;
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
        animation: animUp 0.6s cubic-bezier(0.4,0,0.2,1) forwards;
    }

    @keyframes animUp {
        to { opacity: 1; transform: translateY(0); }
    }

    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.1s; }
    .delay-3 { animation-delay: 0.15s; }
    .delay-4 { animation-delay: 0.2s; }
    .delay-5 { animation-delay: 0.25s; }
    .delay-6 { animation-delay: 0.3s; }
    .delay-7 { animation-delay: 0.35s; }

    /* ═══════════════════════════════
       RESPONSIVE
    ═══════════════════════════════ */
    @media (max-width: 992px) {
        .summary-card { position: static; margin-top: 1rem; }
        .hero-title { font-size: 1.6rem; }
        .form-section { padding: 1.25rem 1.25rem; }
        .form-footer { padding: 1.25rem; flex-wrap: wrap; gap: 0.75rem; }
        .preview-grid { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 576px) {
        .edit-hero { padding: 1.5rem 0 4rem; }
        .hero-title { font-size: 1.35rem; }
        .form-footer { flex-direction: column; }
        .form-footer > * { width: 100%; text-align: center; justify-content: center; }
        .preview-grid { grid-template-columns: 1fr; }
    }
</style>

<!-- ═══════════ HERO ═══════════ -->
<div class="edit-hero">
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
                            <a href="{{ route('produits.show', $produit->id) }}" class="btn-glass">
                                <i class="bi bi-arrow-left-short" style="font-size:1.1rem;"></i>
                                Retour
                            </a>
                            <div class="bc-glass d-none d-md-flex">
                                <a href="{{ route('produits.index') }}"><i class="bi bi-house-fill"></i></a>
                                <span class="sep"><i class="bi bi-chevron-right"></i></span>
                                <a href="{{ route('produits.index') }}">Produits</a>
                                <span class="sep"><i class="bi bi-chevron-right"></i></span>
                                <a href="{{ route('produits.show', $produit->id) }}">{{ Str::limit($produit->nom_produit, 20) }}</a>
                                <span class="sep"><i class="bi bi-chevron-right"></i></span>
                                <span class="current">Modifier</span>
                            </div>
                        </div>
                    </div>

                    <!-- Title -->
                    <div class="anim-up delay-1">
                        <span class="hero-badge">
                            <i class="bi bi-pencil-square"></i>
                            Modification
                        </span>
                    </div>
                    <div class="anim-up delay-2">
                        <h1 class="hero-title">Modifier le Produit</h1>
                        <p class="hero-sub">
                            Mise à jour de <strong>{{ $produit->nom_produit }}</strong>
                            · ID <strong>#PRD-{{ str_pad($produit->id, 4, '0', STR_PAD_LEFT) }}</strong>
                        </p>
                    </div>

                    <!-- Current Info -->
                    <div class="info-pills anim-up delay-3">
                        <span class="info-pill">
                            <i class="bi bi-grid-fill"></i>
                            {{ $produit->categorie->nom }}
                        </span>
                        <span class="info-pill">
                            <i class="bi bi-building"></i>
                            {{ $produit->fournisseur->nom }}
                        </span>
                        <span class="info-pill">
                            <i class="bi bi-tag-fill"></i>
                            {{ number_format($produit->prix_vente, 2) }} DH
                        </span>
                        <span class="info-pill">
                            <i class="bi bi-box-seam-fill"></i>
                            Stock: {{ $produit->stock_actuel }} {{ $produit->unite }}
                        </span>
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
                    <div class="col-lg-8 anim-up delay-4">
                        <form action="{{ route('produits.update', $produit->id) }}" method="POST" id="editForm" onsubmit="return confirm('Êtes-vous sûr de vouloir enregistrer les modifications ?');">
                            @csrf
                            @method('PUT')

                            <div class="form-card">

                                <!-- Section 1: Basic Info -->
                                <div class="form-section">
                                    <div class="section-label">
                                        <div class="section-icon purple">
                                            <i class="bi bi-box-seam-fill"></i>
                                        </div>
                                        <div>
                                            <h6 class="section-title">Informations de base</h6>
                                            <p class="section-desc">Nom, catégorie et fournisseur du produit</p>
                                        </div>
                                    </div>

                                    <!-- Product Name -->
                                    <div class="field-group">
                                        <label class="field-label">
                                            <i class="bi bi-type"></i>
                                            Nom du produit
                                            <span class="readonly-badge">
                                                <i class="bi bi-lock-fill"></i>
                                                Lecture seule
                                            </span>
                                        </label>
                                        <div class="input-icon-wrap">
                                            <i class="bi bi-box-fill input-icon"></i>
                                            <input type="text"
                                                   name="nom_produit"
                                                   value="{{ $produit->nom_produit }}"
                                                   class="custom-input @error('nom_produit') is-invalid @enderror"
                                                   readonly>
                                        </div>
                                        @error('nom_produit')
                                            <div class="error-text"><i class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Category & Supplier -->
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="field-group">
                                                <label class="field-label">
                                                    <i class="bi bi-grid-fill"></i>
                                                    Catégorie
                                                    <span class="required">*</span>
                                                </label>
                                                <select name="categorie_id" class="custom-select @error('categorie_id') is-invalid @enderror">
                                                    <option value="">Sélectionner...</option>
                                                    @foreach ($categories as $ct)
                                                        <option value="{{ $ct->id }}" {{ $produit->categorie_id == $ct->id ? 'selected' : '' }}>
                                                            {{ $ct->nom }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('categorie_id')
                                                    <div class="error-text"><i class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="field-group">
                                                <label class="field-label">
                                                    <i class="bi bi-building"></i>
                                                    Fournisseur
                                                    <span class="required">*</span>
                                                </label>
                                                <select name="fournisseur_id" class="custom-select @error('fournisseur_id') is-invalid @enderror">
                                                    <option value="">Sélectionner...</option>
                                                    @foreach ($fournisseurs as $fr)
                                                        <option value="{{ $fr->id }}" {{ $produit->fournisseur_id == $fr->id ? 'selected' : '' }}>
                                                            {{ $fr->nom }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('fournisseur_id')
                                                    <div class="error-text"><i class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 2: Pricing -->
                                <div class="form-section">
                                    <div class="section-label">
                                        <div class="section-icon green">
                                            <i class="bi bi-cash-stack"></i>
                                        </div>
                                        <div>
                                            <h6 class="section-title">Tarification</h6>
                                            <p class="section-desc">Unité de mesure et prix d'achat / vente</p>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <!-- Unite -->
                                        <div class="col-md-4">
                                            <div class="field-group">
                                                <label class="field-label">
                                                    <i class="bi bi-rulers"></i>
                                                    Unité
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="input-icon-wrap">
                                                    <i class="bi bi-rulers input-icon"></i>
                                                    <input type="text"
                                                           name="unite"
                                                           value="{{ $produit->unite }}"
                                                           placeholder="ex: Kg, L, Pcs"
                                                           class="custom-input @error('unite') is-invalid @enderror">
                                                </div>
                                                @error('unite')
                                                    <div class="error-text"><i class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Prix Achat -->
                                        <div class="col-md-4">
                                            <div class="field-group">
                                                <label class="field-label">
                                                    <i class="bi bi-cart-fill"></i>
                                                    Prix d'achat
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="input-suffix-wrap">
                                                    <input type="number"
                                                           step="0.01"
                                                           name="prix_achat"
                                                           id="prixAchat"
                                                           value="{{ $produit->prix_achat }}"
                                                           placeholder="0.00"
                                                           class="custom-input @error('prix_achat') is-invalid @enderror">
                                                    <span class="input-suffix">DH</span>
                                                </div>
                                                @error('prix_achat')
                                                    <div class="error-text"><i class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Prix Vente -->
                                        <div class="col-md-4">
                                            <div class="field-group">
                                                <label class="field-label">
                                                    <i class="bi bi-tag-fill"></i>
                                                    Prix de vente
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="input-suffix-wrap">
                                                    <input type="number"
                                                           step="0.01"
                                                           name="prix_vente"
                                                           id="prixVente"
                                                           value="{{ $produit->prix_vente }}"
                                                           placeholder="0.00"
                                                           class="custom-input @error('prix_vente') is-invalid @enderror">
                                                    <span class="input-suffix">DH</span>
                                                </div>
                                                @error('prix_vente')
                                                    <div class="error-text"><i class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Live Margin Preview -->
                                    <div class="live-preview" id="marginPreview">
                                        <div class="preview-header">
                                            <div class="preview-dot"></div>
                                            <span class="preview-title">Aperçu en direct</span>
                                        </div>
                                        <div class="preview-grid">
                                            <div class="preview-item">
                                                <div class="preview-item-label">Achat</div>
                                                <div class="preview-item-value accent" id="prevAchat">{{ number_format($produit->prix_achat, 2) }}</div>
                                            </div>
                                            <div class="preview-item">
                                                <div class="preview-item-label">Vente</div>
                                                <div class="preview-item-value" id="prevVente">{{ number_format($produit->prix_vente, 2) }}</div>
                                            </div>
                                            <div class="preview-item">
                                                <div class="preview-item-label">Marge</div>
                                                <div class="preview-item-value green" id="prevMarge">
                                                    +{{ number_format($produit->prix_vente - $produit->prix_achat, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 3: Stock & Expiry -->
                                <div class="form-section">
                                    <div class="section-label">
                                        <div class="section-icon orange">
                                            <i class="bi bi-box-seam-fill"></i>
                                        </div>
                                        <div>
                                            <h6 class="section-title">Stock & Expiration</h6>
                                            <p class="section-desc">Niveaux de stock et date de péremption</p>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <!-- Stock Minimum -->
                                        <div class="col-md-4">
                                            <div class="field-group">
                                                <label class="field-label">
                                                    <i class="bi bi-exclamation-triangle-fill" style="color:var(--orange);"></i>
                                                    Stock minimum
                                                </label>
                                                <div class="input-icon-wrap">
                                                    <i class="bi bi-shield-exclamation input-icon"></i>
                                                    <input type="number"
                                                           name="stock_minimum"
                                                           id="stockMin"
                                                           value="{{ $produit->stock_minimum }}"
                                                           placeholder="0"
                                                           class="custom-input @error('stock_minimum') is-invalid @enderror">
                                                </div>
                                                <div class="field-hint">Seuil d'alerte de réapprovisionnement</div>
                                                @error('stock_minimum')
                                                    <div class="error-text"><i class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Stock Initial -->
                                        <div class="col-md-4">
                                            <div class="field-group">
                                                <label class="field-label">
                                                    <i class="bi bi-boxes" style="color:var(--green);"></i>
                                                    Stock initial
                                                </label>
                                                <div class="input-icon-wrap">
                                                    <i class="bi bi-box-seam input-icon"></i>
                                                    <input type="number"
                                                           name="stock_initial"
                                                           id="stockInitial"
                                                           value="{{ $produit->stock_initial }}"
                                                           placeholder="0"
                                                           class="custom-input @error('stock_initial') is-invalid @enderror">
                                                </div>
                                                <div class="field-hint">Quantité de départ (le stock actuel est calculé automatiquement)</div>
                                                @error('stock_initial')
                                                    <div class="error-text"><i class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Date Expiration -->
                                        <div class="col-md-4">
                                            <div class="field-group">
                                                <label class="field-label">
                                                    <i class="bi bi-calendar-event" style="color:var(--accent);"></i>
                                                    Expiration
                                                </label>
                                                <div class="input-icon-wrap">
                                                    <i class="bi bi-calendar3 input-icon"></i>
                                                    <input type="date"
                                                           name="date_expiration"
                                                           value="{{ $produit->date_expiration }}"
                                                           class="custom-input @error('date_expiration') is-invalid @enderror">
                                                </div>
                                                <div class="field-hint">Laisser vide si non applicable</div>
                                                @error('date_expiration')
                                                    <div class="error-text"><i class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer Actions -->
                                <div class="form-footer">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('produits.show', $produit->id) }}" class="btn-cancel">
                                            <i class="bi bi-x-lg"></i>
                                            Annuler
                                        </a>
                                        <button type="reset" class="btn-outline-light">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                            Réinitialiser
                                        </button>
                                    </div>
                                    <button type="submit" class="btn-submit">
                                        <span class="btn-shine"></span>
                                        <i class="bi bi-check2-circle"></i>
                                        Enregistrer les modifications
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>

                    <!-- Right: Summary Sidebar -->
                    <div class="col-lg-4 anim-up delay-5">

                        <!-- Summary Card -->
                        <div class="summary-card">
                            <div class="summary-header">
                                <div class="summary-header-icon">
                                    <i class="bi bi-clipboard-data-fill"></i>
                                </div>
                                <h6>Résumé actuel</h6>
                            </div>
                            <div class="summary-body">
                                <div class="summary-item">
                                    <span class="summary-item-label">
                                        <i class="bi bi-hash"></i> ID
                                    </span>
                                    <span class="summary-item-value">PRD-{{ str_pad($produit->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <div class="summary-item">
                                    <span class="summary-item-label">
                                        <i class="bi bi-grid-fill"></i> Catégorie
                                    </span>
                                    <span class="summary-item-value" style="color:var(--accent);">{{ $produit->categorie->nom }}</span>
                                </div>
                                <div class="summary-item">
                                    <span class="summary-item-label">
                                        <i class="bi bi-building"></i> Fournisseur
                                    </span>
                                    <span class="summary-item-value" style="color:var(--green);">{{ $produit->fournisseur->nom }}</span>
                                </div>

                                <div class="summary-divider"></div>

                                <div class="summary-item">
                                    <span class="summary-item-label">
                                        <i class="bi bi-cart-fill"></i> Achat
                                    </span>
                                    <span class="summary-item-value">{{ number_format($produit->prix_achat, 2) }} DH</span>
                                </div>
                                <div class="summary-item">
                                    <span class="summary-item-label">
                                        <i class="bi bi-tag-fill"></i> Vente
                                    </span>
                                    <span class="summary-item-value" style="color:var(--green);">{{ number_format($produit->prix_vente, 2) }} DH</span>
                                </div>

                                <!-- Margin -->
                                @php
                                    $marge = $produit->prix_vente - $produit->prix_achat;
                                    $margePercent = $produit->prix_achat > 0 ? ($marge / $produit->prix_achat) * 100 : 0;
                                @endphp
                                <div class="margin-preview" id="marginCard">
                                    <div class="margin-preview-label">Marge bénéficiaire</div>
                                    <div class="margin-preview-value" id="marginValue">+{{ number_format($marge, 2) }} DH</div>
                                    <div class="margin-preview-percent" id="marginPercent">
                                        <i class="bi bi-arrow-up-short"></i>{{ number_format($margePercent, 1) }}%
                                    </div>
                                </div>

                                <!-- Stock Status -->
                                <div class="stock-indicator" id="stockStatus">
                                    @php
                                        $stockClass = $produit->stock_actuel > $produit->stock_minimum ? 'good' : ($produit->stock_actuel > 0 ? 'warn' : 'bad');
                                        $stockText = $produit->stock_actuel > $produit->stock_minimum ? 'En stock' : ($produit->stock_actuel > 0 ? 'Stock faible' : 'Rupture');
                                    @endphp
                                    <div class="stock-dot {{ $stockClass }}"></div>
                                    <div class="stock-info">
                                        <div class="stock-info-label">État du stock</div>
                                        <div class="stock-info-text">
                                            {{ $produit->stock_actuel }} {{ $produit->unite }}
                                            · <span style="color: {{ $stockClass == 'good' ? 'var(--green)' : ($stockClass == 'warn' ? 'var(--orange)' : 'var(--red)') }};">{{ $stockText }}</span>
                                        </div>
                                    </div>
                                </div>

                                @if($produit->date_expiration)
                                    @php
                                        $daysLeft = \Carbon\Carbon::now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($produit->date_expiration)->startOfDay(), false);
                                    @endphp
                                    <div class="stock-indicator" style="margin-top:0.5rem;">
                                        <div class="stock-dot {{ $daysLeft > 30 ? 'good' : ($daysLeft > 0 ? 'warn' : 'bad') }}"></div>
                                        <div class="stock-info">
                                            <div class="stock-info-label">Expiration</div>
                                            <div class="stock-info-text">
                                                {{ \Carbon\Carbon::parse($produit->date_expiration)->format('d/m/Y') }}
                                                ·
                                                @if($daysLeft > 0)
                                                    <span style="color:{{ $daysLeft > 30 ? 'var(--green)' : 'var(--orange)' }};">{{ $daysLeft }}j restants</span>
                                                @else
                                                    <span style="color:var(--red);">Expiré</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Tips -->
                        <div class="tips-card anim-up delay-6">
                            <div class="tips-header">
                                <span>💡</span>
                                <span class="tips-title">Conseils</span>
                            </div>
                            <ul class="tips-list">
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Le prix de vente doit être supérieur au prix d'achat
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Le stock minimum déclenche une alerte automatique
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    La date d'expiration est optionnelle
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Le nom du produit ne peut pas être modifié
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
document.addEventListener('DOMContentLoaded', function() {

    const prixAchat = document.getElementById('prixAchat');
    const prixVente = document.getElementById('prixVente');
    const prevAchat = document.getElementById('prevAchat');
    const prevVente = document.getElementById('prevVente');
    const prevMarge = document.getElementById('prevMarge');
    const marginValue = document.getElementById('marginValue');
    const marginPercent = document.getElementById('marginPercent');
    const marginCard = document.getElementById('marginCard');

    function updatePreview() {
        const achat = parseFloat(prixAchat.value) || 0;
        const vente = parseFloat(prixVente.value) || 0;
        const marge = vente - achat;
        const pct = achat > 0 ? ((marge / achat) * 100) : 0;

        prevAchat.textContent = achat.toFixed(2);
        prevVente.textContent = vente.toFixed(2);

        if (marge >= 0) {
            prevMarge.textContent = '+' + marge.toFixed(2);
            prevMarge.style.color = '#059669';
            marginValue.textContent = '+' + marge.toFixed(2) + ' DH';
            marginPercent.innerHTML = '<i class="bi bi-arrow-up-short"></i>' + pct.toFixed(1) + '%';
            marginCard.style.background = 'linear-gradient(135deg, #ecfdf5, #d1fae5)';
            marginCard.style.borderColor = '#a7f3d0';
            marginValue.style.color = '#059669';
            marginPercent.style.color = '#10b981';
        } else {
            prevMarge.textContent = marge.toFixed(2);
            prevMarge.style.color = '#dc2626';
            marginValue.textContent = marge.toFixed(2) + ' DH';
            marginPercent.innerHTML = '<i class="bi bi-arrow-down-short"></i>' + Math.abs(pct).toFixed(1) + '%';
            marginCard.style.background = 'linear-gradient(135deg, #fef2f2, #fecaca)';
            marginCard.style.borderColor = '#fca5a5';
            marginValue.style.color = '#dc2626';
            marginPercent.style.color = '#ef4444';
        }
    }

    if (prixAchat && prixVente) {
        prixAchat.addEventListener('input', updatePreview);
        prixVente.addEventListener('input', updatePreview);
    }

    // Stock status live update
    const stockActuel = document.getElementById('stockInitial');
    const stockMin = document.getElementById('stockMin');

    function updateStockStatus() {
        const actual = parseInt(stockActuel.value) || 0;
        const minimum = parseInt(stockMin.value) || 0;
        const statusEl = document.getElementById('stockStatus');

        if (!statusEl) return;

        let dotClass, statusText, statusColor;

        if (actual > minimum && actual > 0) {
            dotClass = 'good';
            statusText = 'En stock';
            statusColor = 'var(--green)';
        } else if (actual > 0) {
            dotClass = 'warn';
            statusText = 'Stock faible';
            statusColor = 'var(--orange)';
        } else {
            dotClass = 'bad';
            statusText = 'Rupture';
            statusColor = 'var(--red)';
        }

        const dot = statusEl.querySelector('.stock-dot');
        dot.className = 'stock-dot ' + dotClass;

        const text = statusEl.querySelector('.stock-info-text');
        text.innerHTML = actual + ' unités · <span style="color:' + statusColor + ';">' + statusText + '</span>';
    }

    if (stockActuel && stockMin) {
        stockActuel.addEventListener('input', updateStockStatus);
        stockMin.addEventListener('input', updateStockStatus);
    }

    // Form validation visual feedback
    const form = document.getElementById('editForm');
    const requiredInputs = form.querySelectorAll('.custom-input:not([readonly]), .custom-select');

    requiredInputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() === '' && this.hasAttribute('required')) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });

        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    });
});
</script>
@endsection