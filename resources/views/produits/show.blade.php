@extends('_layout')

@section('title', 'Détails Produit')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

    :root {
        --bg-primary: #f5f6fa;
        --bg-white: #ffffff;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
        --text-muted: #94a3b8;
        --accent-1: #6366f1;
        --accent-2: #8b5cf6;
        --accent-3: #06b6d4;
        --accent-green: #10b981;
        --accent-orange: #f59e0b;
        --accent-red: #ef4444;
        --accent-pink: #ec4899;
        --border-light: #e2e8f0;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.04);
        --shadow-md: 0 4px 20px rgba(0,0,0,0.06);
        --shadow-lg: 0 10px 40px rgba(0,0,0,0.08);
        --shadow-xl: 0 25px 60px rgba(0,0,0,0.1);
        --radius-sm: 12px;
        --radius-md: 16px;
        --radius-lg: 24px;
        --radius-xl: 32px;
    }

    * { font-family: 'Inter', sans-serif; }

    body { background: var(--bg-primary); }

    /* ═══════════════════════════════════
       HERO SECTION
    ═══════════════════════════════════ */
    .hero-wrapper {
        position: relative;
        overflow: hidden;
    }

    .hero-bg {
        background: linear-gradient(160deg, var(--blue-900) 0%, var(--blue-800) 30%, var(--blue-700) 60%, var(--blue-600) 100%);
        padding: 2.5rem 0 6rem;
        position: relative;
    }

    .hero-bg::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 600px 400px at 80% 20%, rgba(59, 130, 246, 0.25), transparent),
            radial-gradient(ellipse 400px 300px at 20% 80%, rgba(37, 99, 235, 0.2), transparent),
            radial-gradient(ellipse 300px 300px at 50% 50%, rgba(96, 165, 250, 0.1), transparent);
    }

    .hero-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(circle 1px at 20% 30%, rgba(255,255,255,0.15), transparent),
            radial-gradient(circle 1px at 40% 70%, rgba(255,255,255,0.1), transparent),
            radial-gradient(circle 1px at 60% 20%, rgba(255,255,255,0.12), transparent),
            radial-gradient(circle 1px at 80% 60%, rgba(255,255,255,0.08), transparent),
            radial-gradient(circle 1px at 10% 80%, rgba(255,255,255,0.1), transparent),
            radial-gradient(circle 1px at 90% 40%, rgba(255,255,255,0.12), transparent),
            radial-gradient(circle 2px at 30% 50%, rgba(255,255,255,0.06), transparent),
            radial-gradient(circle 2px at 70% 90%, rgba(255,255,255,0.08), transparent);
    }

    /* Animated orbs */
    .orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        animation: orbFloat 8s ease-in-out infinite;
        z-index: 0;
    }

    .orb-1 {
        width: 300px; height: 300px;
        background: rgba(59, 130, 246, 0.15);
        top: -100px; right: -50px;
        animation-delay: 0s;
    }

    .orb-2 {
        width: 200px; height: 200px;
        background: rgba(96, 165, 250, 0.1);
        bottom: -50px; left: 10%;
        animation-delay: 3s;
    }

    .orb-3 {
        width: 150px; height: 150px;
        background: rgba(191, 219, 254, 0.12);
        top: 20%; left: 60%;
        animation-delay: 5s;
    }

    @keyframes orbFloat {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(20px, -20px) scale(1.05); }
        66% { transform: translate(-15px, 15px) scale(0.95); }
    }

    /* Nav Bar */
    .hero-nav {
        position: relative;
        z-index: 10;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem;
    }

    .btn-glass {
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.12);
        color: rgba(255,255,255,0.9);
        border-radius: var(--radius-sm);
        padding: 0.55rem 1.2rem;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .btn-glass:hover {
        background: rgba(255,255,255,0.16);
        border-color: rgba(255,255,255,0.25);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    }

    .btn-glass-primary {
        background: rgba(37, 99, 235, 0.3);
        border-color: rgba(37, 99, 235, 0.4);
    }

    .btn-glass-primary:hover {
        background: rgba(37, 99, 235, 0.5);
        border-color: rgba(37, 99, 235, 0.6);
    }

    .btn-glass-danger {
        background: rgba(239,68,68,0.15);
        border-color: rgba(239,68,68,0.25);
        color: rgba(252,165,165,0.9);
    }

    .btn-glass-danger:hover {
        background: rgba(239,68,68,0.35);
        border-color: rgba(239,68,68,0.5);
        color: #fff;
    }

    /* Breadcrumb */
    .breadcrumb-glass {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.78rem;
    }

    .breadcrumb-glass a {
        color: rgba(255,255,255,0.5);
        text-decoration: none;
        transition: color 0.3s;
    }

    .breadcrumb-glass a:hover { color: rgba(255,255,255,0.9); }

    .breadcrumb-glass .sep {
        color: rgba(255,255,255,0.2);
        font-size: 0.6rem;
    }

    .breadcrumb-glass .active {
        color: rgba(255,255,255,0.85);
        font-weight: 600;
    }

    /* Hero Content */
    .hero-content {
        position: relative;
        z-index: 10;
    }

    .product-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.3), rgba(59, 130, 246, 0.3));
        border: 1px solid rgba(37, 99, 235, 0.3);
        color: var(--blue-100);
        border-radius: 50px;
        padding: 0.3rem 0.85rem;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .product-name {
        font-size: 2.5rem;
        font-weight: 900;
        color: #fff;
        letter-spacing: -1px;
        line-height: 1.15;
        margin: 0.75rem 0 0;
        background: linear-gradient(135deg, #ffffff 0%, rgba(255,255,255,0.85) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .product-subtitle {
        color: rgba(255,255,255,0.5);
        font-size: 0.85rem;
        font-weight: 400;
        margin-top: 0.35rem;
    }

    /* Hero Tags */
    .tag-row { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 1.25rem; }

    .hero-tag {
        background: rgba(255,255,255,0.06);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 50px;
        padding: 0.4rem 0.9rem;
        color: rgba(255,255,255,0.8);
        font-size: 0.72rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.3s;
    }

    .hero-tag:hover {
        background: rgba(255,255,255,0.12);
        border-color: rgba(255,255,255,0.2);
        transform: translateY(-1px);
    }

    .hero-tag i { opacity: 0.6; font-size: 0.68rem; }

    /* Price Card */
    .price-card {
        background: rgba(255,255,255,0.06);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: var(--radius-lg);
        padding: 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .price-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    }

    .price-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 20%;
        right: 20%;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.4), transparent);
    }

    .price-label {
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 3px;
        color: rgba(255,255,255,0.4);
        margin-bottom: 0.5rem;
    }

    .price-value {
        font-size: 3.2rem;
        font-weight: 900;
        background: linear-gradient(135deg, #fff 0%, var(--blue-100) 50%, var(--blue-300) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
        letter-spacing: -1px;
    }

    .price-unit {
        font-size: 0.85rem;
        font-weight: 700;
        color: rgba(255,255,255,0.35);
        letter-spacing: 3px;
        margin-top: 0.35rem;
    }

    .price-margin {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(255,255,255,0.08);
    }

    .price-margin-label {
        font-size: 0.6rem;
        color: rgba(255,255,255,0.35);
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
    }

    .price-margin-value {
        font-size: 1.1rem;
        font-weight: 800;
        color: #34d399;
        margin-top: 0.15rem;
    }

    /* ═══════════════════════════════════
       CARDS AREA
    ═══════════════════════════════════ */
    .cards-area {
        margin-top: -3rem;
        position: relative;
        z-index: 20;
        padding-bottom: 2rem;
    }

    /* Metric Cards */
    .metric-card {
        background: var(--bg-white);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        border: 1px solid var(--border-light);
        box-shadow: var(--shadow-md);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .metric-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        opacity: 0;
        transition: opacity 0.4s;
    }

    .metric-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-xl);
        border-color: transparent;
    }

    .metric-card:hover::before { opacity: 1; }

    .metric-card.v-blue::before { background: linear-gradient(90deg, var(--blue-500), var(--blue-700)); }
    .metric-card.v-green::before { background: linear-gradient(90deg, #10b981, #06b6d4); }
    .metric-card.v-dark::before { background: linear-gradient(90deg, var(--blue-900), var(--blue-500)); }
    .metric-card.v-orange::before { background: linear-gradient(90deg, #f59e0b, #ef4444); }

    .metric-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .metric-icon-wrap {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        position: relative;
    }

    .metric-icon-wrap::after {
        content: '';
        position: absolute;
        inset: -3px;
        border-radius: 17px;
        opacity: 0.15;
    }

    .metric-icon-wrap.blue {
        background: linear-gradient(135deg, var(--blue-50), var(--blue-100));
        color: var(--blue-600);
    }
    .metric-icon-wrap.blue::after { background: var(--blue-600); }

    .metric-icon-wrap.green {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        color: #10b981;
    }
    .metric-icon-wrap.green::after { background: #10b981; }

    .metric-icon-wrap.dark {
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        color: #334155;
    }
    .metric-icon-wrap.dark::after { background: #334155; }

    .metric-icon-wrap.orange {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #d97706;
    }
    .metric-icon-wrap.orange::after { background: #d97706; }

    .metric-trend {
        font-size: 0.65rem;
        font-weight: 700;
        padding: 0.2rem 0.5rem;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 0.2rem;
    }

    .metric-trend.up {
        background: #ecfdf5;
        color: #059669;
    }

    .metric-trend.neutral {
        background: #f1f5f9;
        color: #64748b;
    }

    .metric-label {
        font-size: 0.68rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
        margin-bottom: 0.35rem;
    }

    .metric-val {
        font-size: 1.65rem;
        font-weight: 800;
        color: var(--text-primary);
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .metric-val .currency {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-muted);
        margin-left: 0.15rem;
    }

    .metric-val.positive { color: #059669; }
    .metric-val.negative { color: #dc2626; }
    .metric-val.warning-val { color: #d97706; }
    .metric-val.danger-val { color: #dc2626; }

    .metric-bar {
        height: 4px;
        background: #f1f5f9;
        border-radius: 4px;
        margin-top: 0.75rem;
        overflow: hidden;
    }

    .metric-bar-fill {
        height: 100%;
        border-radius: 4px;
        transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .metric-bar-fill.blue { background: linear-gradient(90deg, var(--blue-500), var(--blue-400)); }
    .metric-bar-fill.green { background: linear-gradient(90deg, #10b981, #06b6d4); }
    .metric-bar-fill.dark { background: linear-gradient(90deg, var(--blue-800), var(--blue-500)); }
    .metric-bar-fill.orange { background: linear-gradient(90deg, #f59e0b, #ef4444); }

    /* ═══════════════════════════════════
       DETAIL SECTIONS
    ═══════════════════════════════════ */
    .section-card {
        background: var(--bg-white);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        overflow: hidden;
        transition: all 0.4s;
        height: 100%;
    }

    .section-card:hover {
        box-shadow: var(--shadow-lg);
        border-color: #ddd6fe;
    }

    .section-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border-light);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: linear-gradient(180deg, #fafbff, #fff);
    }

    .section-header-icon {
        width: 38px;
        height: 38px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
    }

    .section-header-icon.purple {
        background: linear-gradient(135deg, var(--blue-50), var(--blue-100));
        color: var(--blue-600);
    }

    .section-header-icon.amber {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #d97706;
    }

    .section-header h6 {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--text-secondary);
        margin: 0;
    }

    .section-body {
        padding: 0.5rem 1.5rem;
    }

    /* Detail Rows */
    .info-row {
        display: flex;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #f8fafc;
        transition: all 0.25s;
    }

    .info-row:last-child { border-bottom: none; }

    .info-row:hover {
        background: #fafaff;
        margin: 0 -1.5rem;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    .info-row-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        font-size: 0.85rem;
        margin-right: 1rem;
        flex-shrink: 0;
        transition: all 0.3s;
    }

    .info-row:hover .info-row-icon {
        background: var(--blue-50);
        color: var(--blue-600);
    }

    .info-row-content { flex: 1; min-width: 0; }

    .info-row-label {
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
        line-height: 1;
    }

    .info-row-value {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-top: 0.2rem;
    }

    .info-row-end {
        flex-shrink: 0;
        margin-left: 1rem;
    }

    .value-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.3rem 0.75rem;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 600;
    }

    .value-badge.purple { background: var(--blue-50); color: var(--blue-600); }
    .value-badge.green { background: #ecfdf5; color: #059669; }
    .value-badge.blue { background: #ecfeff; color: #0891b2; }
    .value-badge.orange { background: #fff7ed; color: #ea580c; }

    /* ═══════════════════════════════════
       STOCK VISUALIZATION
    ═══════════════════════════════════ */
    .stock-visual {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1rem 0;
    }

    .gauge-container {
        position: relative;
        width: 160px;
        height: 160px;
        margin-bottom: 1.5rem;
    }

    .gauge-container svg {
        width: 160px;
        height: 160px;
        transform: rotate(-90deg);
    }

    .gauge-track {
        fill: none;
        stroke: #f1f5f9;
        stroke-width: 10;
    }

    .gauge-progress {
        fill: none;
        stroke-width: 10;
        stroke-linecap: round;
        stroke-dasharray: 408.4;
        transition: stroke-dashoffset 2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .gauge-glow {
        fill: none;
        stroke-width: 14;
        stroke-linecap: round;
        stroke-dasharray: 408.4;
        opacity: 0.15;
        filter: blur(4px);
        transition: stroke-dashoffset 2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .gauge-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .gauge-number {
        font-size: 2.5rem;
        font-weight: 900;
        color: var(--text-primary);
        line-height: 1;
        letter-spacing: -1px;
    }

    .gauge-unit {
        font-size: 0.6rem;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-top: 0.15rem;
    }

    .gauge-ring-bg {
        position: absolute;
        inset: 15px;
        border-radius: 50%;
        background: linear-gradient(135deg, #fafaff, #f8fafc);
        box-shadow: inset 0 2px 8px rgba(0,0,0,0.04);
    }

    /* Status Chip */
    .status-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.5rem;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .status-chip.good {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        color: #059669;
        border: 1px solid #a7f3d0;
    }

    .status-chip.warning {
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        color: #d97706;
        border: 1px solid #fde68a;
    }

    .status-chip.danger {
        background: linear-gradient(135deg, #fef2f2, #fecaca);
        color: #dc2626;
        border: 1px solid #fca5a5;
    }

    .pulse-ring {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        position: relative;
    }

    .pulse-ring::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 50%;
        animation: pulseRing 2s ease-out infinite;
    }

    .pulse-ring::after {
        content: '';
        position: absolute;
        inset: 2px;
        border-radius: 50%;
    }

    .pulse-ring.good::before { background: rgba(16,185,129,0.3); }
    .pulse-ring.good::after { background: #10b981; }
    .pulse-ring.warning::before { background: rgba(245,158,11,0.3); }
    .pulse-ring.warning::after { background: #f59e0b; }
    .pulse-ring.danger::before { background: rgba(239,68,68,0.3); }
    .pulse-ring.danger::after { background: #ef4444; }

    @keyframes pulseRing {
        0% { transform: scale(1); opacity: 1; }
        100% { transform: scale(2.5); opacity: 0; }
    }

    /* Expiration Card */
    .exp-card {
        background: linear-gradient(135deg, #fafaff, #f5f3ff);
        border: 1px solid #e9e5ff;
        border-radius: var(--radius-md);
        padding: 1.25rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .exp-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, #6366f1, #8b5cf6, #ec4899);
    }

    .exp-emoji { font-size: 1.8rem; margin-bottom: 0.5rem; }

    .exp-label {
        font-size: 0.58rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2.5px;
        color: var(--text-muted);
    }

    .exp-date {
        font-size: 1rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-top: 0.25rem;
    }

    .exp-countdown {
        margin-top: 0.75rem;
        padding-top: 0.75rem;
        border-top: 1px solid #e9e5ff;
    }

    .exp-days {
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .exp-days.safe { background: #ecfdf5; color: #059669; }
    .exp-days.near { background: #fffbeb; color: #d97706; }
    .exp-days.expired { background: #fef2f2; color: #dc2626; }

    /* Stock Bars */
    .stock-levels {
        width: 100%;
        margin-top: 0.5rem;
    }

    .stock-level-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 0;
    }

    .stock-level-label {
        font-size: 0.65rem;
        font-weight: 600;
        color: var(--text-muted);
        min-width: 50px;
        text-align: right;
    }

    .stock-level-bar {
        flex: 1;
        height: 6px;
        background: #f1f5f9;
        border-radius: 6px;
        overflow: hidden;
    }

    .stock-level-fill {
        height: 100%;
        border-radius: 6px;
        transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stock-level-val {
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--text-primary);
        min-width: 30px;
    }

    /* ═══════════════════════════════════
       PRICE COMPARISON BAR
    ═══════════════════════════════════ */
    .price-compare {
        background: #f8fafc;
        border-radius: var(--radius-sm);
        padding: 1rem 1.25rem;
        margin-top: 0.5rem;
    }

    .price-compare-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
    }

    .price-compare-label {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .price-compare-label.buy { color: #6366f1; }
    .price-compare-label.sell { color: #10b981; }

    .price-compare-bar {
        height: 8px;
        background: #e2e8f0;
        border-radius: 8px;
        display: flex;
        overflow: hidden;
    }

    .price-compare-bar .buy-part {
        background: linear-gradient(90deg, #6366f1, #818cf8);
        transition: width 1.5s ease;
    }

    .price-compare-bar .margin-part {
        background: linear-gradient(90deg, #34d399, #10b981);
        transition: width 1.5s ease;
    }

    .price-compare-legend {
        display: flex;
        gap: 1.25rem;
        margin-top: 0.75rem;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.65rem;
        font-weight: 600;
        color: var(--text-secondary);
    }

    .legend-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    .legend-dot.buy { background: #6366f1; }
    .legend-dot.margin { background: #10b981; }

    /* ═══════════════════════════════════
       FOOTER
    ═══════════════════════════════════ */
    .page-footer {
        background: var(--bg-white);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        padding: 1rem 1.5rem;
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .footer-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #10b981;
        box-shadow: 0 0 0 3px rgba(16,185,129,0.15);
    }

    /* ═══════════════════════════════════
       ANIMATIONS
    ═══════════════════════════════════ */
    .anim-fade-up {
        opacity: 0;
        transform: translateY(30px);
        animation: animFadeUp 0.7s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    @keyframes animFadeUp {
        to { opacity: 1; transform: translateY(0); }
    }

    .anim-delay-1 { animation-delay: 0.1s; }
    .anim-delay-2 { animation-delay: 0.2s; }
    .anim-delay-3 { animation-delay: 0.3s; }
    .anim-delay-4 { animation-delay: 0.4s; }
    .anim-delay-5 { animation-delay: 0.5s; }
    .anim-delay-6 { animation-delay: 0.6s; }

    .anim-scale-in {
        opacity: 0;
        transform: scale(0.9);
        animation: animScaleIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    @keyframes animScaleIn {
        to { opacity: 1; transform: scale(1); }
    }

    .anim-slide-right {
        opacity: 0;
        transform: translateX(-30px);
        animation: animSlideRight 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    @keyframes animSlideRight {
        to { opacity: 1; transform: translateX(0); }
    }

    /* Counter animation */
    .counter-animate {
        display: inline-block;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .product-name { font-size: 1.75rem; }
        .price-value { font-size: 2.2rem; }
        .hero-bg { padding: 1.5rem 0 5rem; }
        .hero-nav { flex-direction: column; gap: 1rem; align-items: flex-start; }
        .hero-nav .d-flex:last-child { align-self: flex-end; margin-top: -2.5rem; }
        .gauge-container { width: 130px; height: 130px; }
        .gauge-container svg { width: 130px; height: 130px; }
        .gauge-number { font-size: 2rem; }
        .metric-val { font-size: 1.35rem; }
    }
</style>

<!-- ═══════════ HERO ═══════════ -->
<div class="hero-wrapper">
    <div class="hero-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <!-- Nav -->
                    <div class="hero-nav">
                        <div class="d-flex align-items-center gap-3">
                            <a href="{{ route('produits.index') }}" class="btn-glass">
                                <i class="bi bi-arrow-left-short" style="font-size:1.1rem;"></i>
                                Retour
                            </a>
                            <div class="breadcrumb-glass d-none d-md-flex">
                                <a href="{{ route('produits.index') }}"><i class="bi bi-house-fill"></i></a>
                                <span class="sep"><i class="bi bi-chevron-right"></i></span>
                                <a href="{{ route('produits.index') }}">Produits</a>
                                <span class="sep"><i class="bi bi-chevron-right"></i></span>
                                <span class="active">{{ Str::limit($produit->nom_produit, 25) }}</span>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('produits.edit', $produit->id) }}" class="btn-glass btn-glass-primary">
                                <i class="bi bi-pencil-square"></i>
                                <span class="d-none d-sm-inline">Modifier</span>
                            </a>
                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-glass btn-glass-danger">
                                    <i class="bi bi-trash3"></i>
                                    <span class="d-none d-sm-inline">Supprimer</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Hero Content -->
                    <div class="hero-content">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-4 mb-4 mb-md-0 text-center text-md-start">
                                <div class="anim-scale-in anim-delay-1 d-inline-block position-relative">
                                    @if($produit->img_pr)
                                        <img src="{{ str_starts_with($produit->img_pr, 'data:') ? $produit->img_pr : asset($produit->img_pr) }}" alt="{{ $produit->nom_produit }}" class="img-fluid rounded-4 shadow-lg border border-white border-2" style="max-height: 220px; width: 100%; object-fit: cover; aspect-ratio: 1/1;">
                                    @else
                                        <div class="rounded-4 shadow-lg border border-white border-2 bg-white bg-opacity-10 d-flex align-items-center justify-content-center mx-auto" style="height: 180px; width: 180px;">
                                            <i class="bi bi-box-seam text-white opacity-50" style="font-size: 4rem;"></i>
                                        </div>
                                    @endif
                                    
                                    <!-- Mobile Price Badge -->
                                    <div class="d-md-none position-absolute bottom-0 end-0 mb-2 me-2">
                                        <span class="badge bg-success shadow-sm p-2 rounded-3">
                                            {{ number_format($produit->prix_vente, 2) }} DH
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-8">
                                <div class="anim-fade-up anim-delay-1 text-center text-md-start">
                                    <span class="product-badge">
                                        <i class="bi bi-hash"></i>
                                        PRD-{{ str_pad($produit->id, 4, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>
                                <div class="anim-fade-up anim-delay-2 text-center text-md-start">
                                    <h1 class="product-name">{{ $produit->nom_produit }}</h1>
                                    <p class="product-subtitle mb-0">
                                        Géré par <strong style="color:rgba(255,255,255,0.7);">{{ $produit->fournisseur->nom }}</strong>
                                    </p>
                                </div>
                                <div class="tag-row anim-fade-up anim-delay-3 justify-content-center justify-content-md-start">
                                    <span class="hero-tag">
                                        <i class="bi bi-grid-fill"></i>
                                        {{ $produit->categorie->nom }}
                                    </span>
                                    <span class="hero-tag">
                                        <i class="bi bi-rulers"></i>
                                        {{ $produit->unite }}
                                    </span>
                                    @if($produit->stock_actuel > 10)
                                        <span class="hero-tag" style="border-color:rgba(16,185,129,0.4);color:#6ee7b7;">
                                            <i class="bi bi-check-circle-fill"></i>
                                            En stock
                                        </span>
                                    @elseif($produit->stock_actuel > 0)
                                        <span class="hero-tag" style="border-color:rgba(245,158,11,0.4);color:#fcd34d;">
                                            <i class="bi bi-exclamation-triangle-fill"></i>
                                            Stock faible
                                        </span>
                                    @else
                                        <span class="hero-tag" style="border-color:rgba(239,68,68,0.4);color:#fca5a5;">
                                            <i class="bi bi-x-circle-fill"></i>
                                            Rupture
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3 d-none d-lg-block">
                                <div class="anim-scale-in anim-delay-3 text-lg-end">
                                    <div class="price-card d-inline-block">
                                        <div class="price-label">Prix de vente</div>
                                        <div class="price-value">{{ number_format($produit->prix_vente, 2) }}</div>
                                        <div class="price-unit">MAD</div>
                                        @php $marge = $produit->prix_vente - $produit->prix_achat; @endphp
                                        @if($marge > 0)
                                            <div class="price-margin">
                                                <div class="price-margin-label">Marge bénéficiaire</div>
                                                <div class="price-margin-value">
                                                    <i class="bi bi-arrow-up-short"></i>
                                                    +{{ number_format($marge, 2) }} MAD
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════ CARDS ═══════════ -->
<div class="cards-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <!-- Metrics Row -->
                <div class="row g-3 mb-4">
                    @php
                        $marge = $produit->prix_vente - $produit->prix_achat;
                        $margePercent = $produit->prix_achat > 0 ? ($marge / $produit->prix_achat) * 100 : 0;
                        $maxStock = 100;
                        $stockPercent = min(($produit->stock_actuel / $maxStock) * 100, 100);
                    @endphp

                    <div class="col-6 col-lg-3 anim-fade-up anim-delay-1">
                        <div class="metric-card v-blue">
                            <div class="metric-top">
                                <div class="metric-icon-wrap blue">
                                    <i class="bi bi-cart-fill"></i>
                                </div>
                            </div>
                            <div class="metric-label">Prix d'achat</div>
                            <div class="metric-val">
                                {{ number_format($produit->prix_achat, 2) }}
                                <span class="currency d-none d-sm-inline">DH</span>
                            </div>
                            <div class="metric-bar">
                                <div class="metric-bar-fill blue" style="width: {{ min(($produit->prix_achat / max($produit->prix_vente, 1)) * 100, 100) }}%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 anim-fade-up anim-delay-2">
                        <div class="metric-card v-green">
                            <div class="metric-top">
                                <div class="metric-icon-wrap green">
                                    <i class="bi bi-cash-stack"></i>
                                </div>
                            </div>
                            <div class="metric-label">Prix de vente</div>
                            <div class="metric-val">
                                {{ number_format($produit->prix_vente, 2) }}
                                <span class="currency d-none d-sm-inline">DH</span>
                            </div>
                            <div class="metric-bar">
                                <div class="metric-bar-fill green" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 anim-fade-up anim-delay-3">
                        <div class="metric-card v-dark">
                            <div class="metric-top">
                                <div class="metric-icon-wrap dark">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                            </div>
                            <div class="metric-label">Marge bénéf.</div>
                            <div class="metric-val {{ $marge >= 0 ? 'positive' : 'negative' }}">
                                {{ $marge >= 0 ? '+' : '' }}{{ number_format($marge, 2) }}
                                <span class="currency d-none d-sm-inline">DH</span>
                            </div>
                            <div class="metric-bar">
                                <div class="metric-bar-fill dark" style="width: {{ min(abs($margePercent), 100) }}%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 anim-fade-up anim-delay-4">
                        <div class="metric-card v-orange">
                            <div class="metric-top">
                                <div class="metric-icon-wrap orange">
                                    <i class="bi bi-box-seam-fill"></i>
                                </div>
                            </div>
                            <div class="metric-label">Stock actuel</div>
                            <div class="metric-val {{ $produit->stock_actuel > 10 ? '' : ($produit->stock_actuel > 0 ? 'warning-val' : 'danger-val') }}">
                                {{ $produit->stock_actuel }}
                                <span class="currency d-none d-sm-inline">{{ $produit->unite }}</span>
                            </div>
                            <div class="metric-bar">
                                <div class="metric-bar-fill orange" style="width: {{ $stockPercent }}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Sections -->
                <div class="row g-3 mb-4">

                    <!-- Left: Product Info -->
                    <div class="col-lg-8 anim-fade-up anim-delay-5">
                        <div class="section-card">
                            <div class="section-header">
                                <div class="section-header-icon purple">
                                    <i class="bi bi-info-circle-fill"></i>
                                </div>
                                <h6>Informations du produit</h6>
                            </div>
                            <div class="section-body">

                                <div class="info-row">
                                    <div class="info-row-icon"><i class="bi bi-box-fill"></i></div>
                                    <div class="info-row-content">
                                        <div class="info-row-label">Désignation</div>
                                        <div class="info-row-value">{{ $produit->nom_produit }}</div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="info-row-icon"><i class="bi bi-grid-fill"></i></div>
                                    <div class="info-row-content">
                                        <div class="info-row-label">Catégorie</div>
                                    </div>
                                    <div class="info-row-end">
                                        <span class="value-badge purple">
                                            <i class="bi bi-grid-fill" style="font-size:0.6rem;"></i>
                                            {{ $produit->categorie->nom }}
                                        </span>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="info-row-icon"><i class="bi bi-building"></i></div>
                                    <div class="info-row-content">
                                        <div class="info-row-label">Fournisseur</div>
                                    </div>
                                    <div class="info-row-end">
                                        <span class="value-badge green">
                                            <i class="bi bi-building" style="font-size:0.6rem;"></i>
                                            {{ $produit->fournisseur->nom }}
                                        </span>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="info-row-icon"><i class="bi bi-rulers"></i></div>
                                    <div class="info-row-content">
                                        <div class="info-row-label">Unité de mesure</div>
                                    </div>
                                    <div class="info-row-end">
                                        <span class="value-badge blue">{{ $produit->unite }}</span>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="info-row-icon"><i class="bi bi-cart-fill"></i></div>
                                    <div class="info-row-content">
                                        <div class="info-row-label">Prix d'achat</div>
                                    </div>
                                    <div class="info-row-end">
                                        <span class="info-row-value">{{ number_format($produit->prix_achat, 2) }} DH</span>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="info-row-icon"><i class="bi bi-tag-fill"></i></div>
                                    <div class="info-row-content">
                                        <div class="info-row-label">Prix de vente</div>
                                    </div>
                                    <div class="info-row-end">
                                        <span class="info-row-value" style="color:#059669;">{{ number_format($produit->prix_vente, 2) }} DH</span>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="info-row-icon"><i class="bi bi-calendar-event"></i></div>
                                    <div class="info-row-content">
                                        <div class="info-row-label">Date d'expiration</div>
                                    </div>
                                    <div class="info-row-end">
                                        @if($produit->date_expiration)
                                            <span class="value-badge orange">
                                                <i class="bi bi-calendar-event" style="font-size:0.6rem;"></i>
                                                {{ \Carbon\Carbon::parse($produit->date_expiration)->format('d/m/Y') }}
                                            </span>
                                        @else
                                            <span class="info-row-value text-muted" style="font-weight:500;font-size:0.82rem;">Non définie</span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <!-- Price Comparison -->
                            @php
                                $total = $produit->prix_vente;
                                $buyPercent = $total > 0 ? ($produit->prix_achat / $total) * 100 : 0;
                                $marginPercent = $total > 0 ? ($marge / $total) * 100 : 0;
                            @endphp
                            <div class="px-4 pb-4">
                                <div class="price-compare">
                                    <div class="price-compare-header">
                                        <span class="price-compare-label buy">
                                            Achat: {{ number_format($produit->prix_achat, 2) }} DH
                                        </span>
                                        <span class="price-compare-label sell">
                                            Vente: {{ number_format($produit->prix_vente, 2) }} DH
                                        </span>
                                    </div>
                                    <div class="price-compare-bar">
                                        <div class="buy-part" style="width: {{ $buyPercent }}%;"></div>
                                        <div class="margin-part" style="width: {{ max($marginPercent, 0) }}%;"></div>
                                    </div>
                                    <div class="price-compare-legend">
                                        <span class="legend-item">
                                            <span class="legend-dot buy"></span>
                                            Coût ({{ number_format($buyPercent, 0) }}%)
                                        </span>
                                        <span class="legend-item">
                                            <span class="legend-dot margin"></span>
                                            Marge ({{ number_format(max($marginPercent, 0), 0) }}%)
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Stock Status -->
                    <div class="col-lg-4 anim-fade-up anim-delay-6">
                        <div class="section-card">
                            <div class="section-header">
                                <div class="section-header-icon amber">
                                    <i class="bi bi-speedometer2"></i>
                                </div>
                                <h6>État du stock</h6>
                            </div>
                            <div class="section-body">
                                <div class="stock-visual">

                                    <!-- SVG Gauge -->
                                    @php
                                        $maxStock = max($produit->stock_actuel, 100);
                                        $pct = min(($produit->stock_actuel / $maxStock) * 100, 100);
                                        $circumference = 2 * 3.14159 * 65;
                                        $offset = $circumference - ($circumference * $pct / 100);
                                        $stockClass = $produit->stock_actuel > 10 ? 'good' : ($produit->stock_actuel > 0 ? 'warning' : 'danger');
                                        $strokeColor = $produit->stock_actuel > 10 ? '#10b981' : ($produit->stock_actuel > 0 ? '#f59e0b' : '#ef4444');
                                        $strokeColor2 = $produit->stock_actuel > 10 ? '#06b6d4' : ($produit->stock_actuel > 0 ? '#f97316' : '#dc2626');
                                    @endphp

                                    <div class="gauge-container anim-scale-in anim-delay-5">
                                        <div class="gauge-ring-bg"></div>
                                        <svg viewBox="0 0 140 140">
                                            <defs>
                                                <linearGradient id="gaugeGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                                    <stop offset="0%" style="stop-color:{{ $strokeColor }}" />
                                                    <stop offset="100%" style="stop-color:{{ $strokeColor2 }}" />
                                                </linearGradient>
                                            </defs>
                                            <circle class="gauge-track" cx="70" cy="70" r="65" />
                                            <circle class="gauge-glow" cx="70" cy="70" r="65"
                                                stroke="{{ $strokeColor }}"
                                                style="stroke-dashoffset: {{ $offset }};" />
                                            <circle class="gauge-progress" cx="70" cy="70" r="65"
                                                stroke="url(#gaugeGrad)"
                                                style="stroke-dashoffset: {{ $offset }};" />
                                        </svg>
                                        <div class="gauge-center">
                                            <div class="gauge-number">{{ $produit->stock_actuel }}</div>
                                            <div class="gauge-unit">{{ $produit->unite }}</div>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    @if($produit->stock_actuel > 10)
                                        <div class="status-chip good">
                                            <span class="pulse-ring good"></span>
                                            En stock
                                        </div>
                                    @elseif($produit->stock_actuel > 0)
                                        <div class="status-chip warning">
                                            <span class="pulse-ring warning"></span>
                                            Stock faible
                                        </div>
                                    @else
                                        <div class="status-chip danger">
                                            <span class="pulse-ring danger"></span>
                                            Rupture de stock
                                        </div>
                                    @endif

                                    <!-- Stock Levels -->
                                    <div class="stock-levels">
                                        <div class="stock-level-row">
                                            <span class="stock-level-label">Actuel</span>
                                            <div class="stock-level-bar">
                                                <div class="stock-level-fill" style="width:{{ $pct }}%; background: linear-gradient(90deg, {{ $strokeColor }}, {{ $strokeColor2 }});"></div>
                                            </div>
                                            <span class="stock-level-val">{{ $produit->stock_actuel }}</span>
                                        </div>
                                        <div class="stock-level-row">
                                            <span class="stock-level-label">Min</span>
                                            <div class="stock-level-bar">
                                                <div class="stock-level-fill" style="width:10%; background: linear-gradient(90deg, #ef4444, #f97316);"></div>
                                            </div>
                                            <span class="stock-level-val" style="color:#ef4444;">10</span>
                                        </div>
                                    </div>

                                    <!-- Expiration -->
                                    @if($produit->date_expiration)
                                        @php
                                            $expDate = \Carbon\Carbon::parse($produit->date_expiration);
                                            $daysLeft = \Carbon\Carbon::now()->startOfDay()->diffInDays($expDate->startOfDay(), false);
                                            $expClass = $daysLeft > 30 ? 'safe' : ($daysLeft > 0 ? 'near' : 'expired');
                                        @endphp
                                        <div class="exp-card mt-3">
                                            <div class="exp-emoji">
                                                @if($daysLeft > 30) 📅
                                                @elseif($daysLeft > 0) ⚠️
                                                @else 🚨
                                                @endif
                                            </div>
                                            <div class="exp-label">Date d'expiration</div>
                                            <div class="exp-date">{{ $expDate->format('d M Y') }}</div>
                                            <div class="exp-countdown">
                                                @if($daysLeft > 0)
                                                    <span class="exp-days {{ $expClass }}">
                                                        <i class="bi bi-clock"></i>
                                                        Dans {{ $daysLeft }} jour{{ $daysLeft > 1 ? 's' : '' }}
                                                    </span>
                                                @elseif($daysLeft == 0)
                                                    <span class="exp-days near">
                                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                                        Expire aujourd'hui !
                                                    </span>
                                                @else
                                                    <span class="exp-days expired">
                                                        <i class="bi bi-x-circle-fill"></i>
                                                        Expiré depuis {{ abs($daysLeft) }} jour{{ abs($daysLeft) > 1 ? 's' : '' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="exp-card mt-3">
                                            <div class="exp-emoji">📅</div>
                                            <div class="exp-label">Date d'expiration</div>
                                            <div class="exp-date text-muted" style="font-weight:500;">Non définie</div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="page-footer anim-fade-up anim-delay-6">
                    <div class="d-flex align-items-center gap-2">
                        <div class="footer-dot"></div>
                        <small style="font-size:0.75rem;color:var(--text-muted);font-weight:500;">
                            Dernière mise à jour :
                            <strong style="color:var(--text-secondary);">
                                {{ $produit->updated_at ? $produit->updated_at->format('d/m/Y à H:i') : 'N/A' }}
                            </strong>
                        </small>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <small style="font-size:0.7rem;color:var(--text-muted);font-weight:600;letter-spacing:1px;">
                            PRD-{{ str_pad($produit->id, 4, '0', STR_PAD_LEFT) }}
                        </small>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // Animate gauge on scroll
    document.addEventListener('DOMContentLoaded', function() {
        const gaugeProgress = document.querySelector('.gauge-progress');
        const gaugeGlow = document.querySelector('.gauge-glow');

        if (gaugeProgress) {
            const finalOffset = gaugeProgress.style.strokeDashoffset;
            const circumference = 2 * Math.PI * 65;
            gaugeProgress.style.strokeDashoffset = circumference;
            gaugeGlow.style.strokeDashoffset = circumference;

            setTimeout(() => {
                gaugeProgress.style.strokeDashoffset = finalOffset;
                gaugeGlow.style.strokeDashoffset = finalOffset;
            }, 800);
        }

        // Animate metric bars
        document.querySelectorAll('.metric-bar-fill').forEach((bar, i) => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 600 + (i * 150));
        });

        // Animate stock level bars
        document.querySelectorAll('.stock-level-fill').forEach((bar, i) => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 1200 + (i * 200));
        });

        // Animate price compare bar
        document.querySelectorAll('.buy-part, .margin-part').forEach((bar, i) => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 1000 + (i * 200));
        });
    });
</script>
@endsection