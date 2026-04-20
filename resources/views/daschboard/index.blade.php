@extends('_layout')
@section('title', 'Dashboard - Sofrebak')
@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        * { font-family: 'Inter', sans-serif; }

        /* ══════════════════════════════
           HERO BANNER
        ══════════════════════════════ */
        .db-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 30%, #1e3a6e 60%, #2563eb 100%);
            border-radius: 24px;
            padding: 2.2rem 2.5rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .db-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 500px 350px at 80% 20%, rgba(59, 130, 246, 0.3), transparent),
                radial-gradient(ellipse 300px 250px at 10% 80%, rgba(139, 92, 246, 0.15), transparent);
        }

        /* Floating orbs */
        .db-hero-orb {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .db-orb-1 {
            width: 220px; height: 220px;
            background: rgba(59, 130, 246, 0.12);
            top: -80px; right: 3%;
            filter: blur(60px);
            animation: orbFloat 8s ease-in-out infinite alternate;
        }

        .db-orb-2 {
            width: 150px; height: 150px;
            background: rgba(139, 92, 246, 0.1);
            bottom: -50px; right: 20%;
            filter: blur(50px);
            animation: orbFloat 6s ease-in-out infinite alternate-reverse;
        }

        .db-orb-3 {
            width: 100px; height: 100px;
            background: rgba(96, 165, 250, 0.08);
            top: 20%; left: 5%;
            filter: blur(40px);
            animation: orbFloat 10s ease-in-out infinite alternate;
        }

        @keyframes orbFloat {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(15px, -20px) scale(1.15); }
        }

        /* Decorative grid pattern */
        .db-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }

        .db-hero-inner {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .db-greeting-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(59, 130, 246, 0.2);
            border: 1px solid rgba(59, 130, 246, 0.35);
            color: #93c5fd;
            border-radius: 50px;
            padding: 0.28rem 0.85rem;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            margin-bottom: 0.75rem;
            backdrop-filter: blur(10px);
        }

        .db-greeting h1 {
            font-size: 1.85rem;
            font-weight: 900;
            margin: 0 0 0.4rem;
            background: linear-gradient(135deg, #fff 30%, rgba(147, 197, 253, 0.9));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .db-greeting p {
            color: rgba(148, 163, 184, 0.8);
            font-size: 0.85rem;
            margin: 0;
            font-weight: 500;
        }

        .db-hero-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.65rem 1.3rem;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #e2e8f0;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-hero-primary:hover {
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .btn-hero-solid {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.65rem 1.3rem;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            color: #fff;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 18px rgba(37, 99, 235, 0.45);
        }

        .btn-hero-solid:hover {
            background: linear-gradient(135deg, #60a5fa, #3b82f6);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.55);
        }

        /* ══════════════════════════════
           KPI CARDS
        ══════════════════════════════ */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1.15rem;
            margin-bottom: 1.75rem;
        }

        .kpi-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 1.35rem 1.4rem;
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            opacity: 0;
            animation: aUp 0.55s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--kpi-accent);
            border-radius: 18px 18px 0 0;
        }

        .kpi-card:nth-child(1) { --kpi-accent: #3b82f6; --kc: #93c5fd; animation-delay: 0.05s; }
        .kpi-card:nth-child(2) { --kpi-accent: #8b5cf6; --kc: #c4b5fd; animation-delay: 0.1s; }
        .kpi-card:nth-child(3) { --kpi-accent: #f59e0b; --kc: #fcd34d; animation-delay: 0.15s; }
        .kpi-card:nth-child(4) { --kpi-accent: #10b981; --kc: #6ee7b7; animation-delay: 0.2s; }
        .kpi-card:nth-child(5) { --kpi-accent: #ef4444; --kc: #fca5a5; animation-delay: 0.25s; }

        .kpi-card::after {
            content: '';
            position: absolute;
            bottom: -20px; right: -20px;
            width: 90px; height: 90px;
            background: radial-gradient(circle, var(--kc), transparent 70%);
            opacity: 0.2;
            border-radius: 50%;
            pointer-events: none;
        }

        .kpi-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.85rem;
        }

        .kpi-label {
            font-size: 0.68rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .kpi-icon {
            width: 40px; height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: #fff;
            flex-shrink: 0;
        }

        .kpi-card:nth-child(1) .kpi-icon { background: linear-gradient(135deg, #3b82f6, #1d4ed8); box-shadow: 0 5px 14px rgba(59,130,246,0.3); }
        .kpi-card:nth-child(2) .kpi-icon { background: linear-gradient(135deg, #8b5cf6, #6d28d9); box-shadow: 0 5px 14px rgba(139,92,246,0.3); }
        .kpi-card:nth-child(3) .kpi-icon { background: linear-gradient(135deg, #f59e0b, #d97706); box-shadow: 0 5px 14px rgba(245,158,11,0.3); }
        .kpi-card:nth-child(4) .kpi-icon { background: linear-gradient(135deg, #10b981, #059669); box-shadow: 0 5px 14px rgba(16,185,129,0.3); }
        .kpi-card:nth-child(5) .kpi-icon { background: linear-gradient(135deg, #ef4444, #dc2626); box-shadow: 0 5px 14px rgba(239,68,68,0.3); }

        .kpi-value {
            font-size: 1.6rem;
            font-weight: 900;
            color: #0f172a;
            line-height: 1;
            margin-bottom: 0.35rem;
            letter-spacing: -0.5px;
        }

        .kpi-value small {
            font-size: 0.85rem;
            font-weight: 600;
            color: #94a3b8;
        }

        .kpi-sub {
            font-size: 0.7rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        /* ══════════════════════════════
           MAIN GRID
        ══════════════════════════════ */
        .main-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 1.5rem;
            align-items: start;
        }

        .panel {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            opacity: 0;
            animation: aUp 0.55s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .panel-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.3rem 1.75rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .panel-title {
            font-size: 0.92rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .panel-link {
            font-size: 0.75rem;
            font-weight: 700;
            color: #3b82f6;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.3rem 0.75rem;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .panel-link:hover {
            color: #1d4ed8;
            background: #eff6ff;
        }

        .panel-body { padding: 1.4rem 1.75rem; }

        /* ── Chart ── */
        .chart-canvas-wrapper {
            position: relative;
            width: 100%;
            height: 280px;
        }

        .chart-canvas-wrapper canvas {
            width: 100% !important;
            height: 100% !important;
        }

        .chart-legend {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            margin-bottom: 0.75rem;
        }

        .chart-legend-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.72rem;
            font-weight: 600;
            color: #64748b;
        }

        .chart-legend-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .chart-total-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border: 1px solid #bfdbfe;
            color: #1d4ed8;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
        }

        /* ── Finance Section ── */
        .finance-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .finance-card {
            border-radius: 14px;
            padding: 1.1rem 1.25rem;
            position: relative;
            overflow: hidden;
        }

        .finance-card.revenue {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border: 1px solid #bfdbfe;
        }

        .finance-card.expense {
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            border: 1px solid #fecaca;
        }

        .finance-card-icon {
            width: 32px; height: 32px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            color: #fff;
            margin-bottom: 0.75rem;
        }

        .finance-card.revenue .finance-card-icon { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
        .finance-card.expense .finance-card-icon { background: linear-gradient(135deg, #ef4444, #dc2626); }

        .finance-card-label {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .finance-card.revenue .finance-card-label { color: #3b82f6; }
        .finance-card.expense .finance-card-label { color: #ef4444; }

        .finance-card-value {
            font-size: 1.3rem;
            font-weight: 900;
            line-height: 1;
        }

        .finance-card.revenue .finance-card-value { color: #1d4ed8; }
        .finance-card.expense .finance-card-value { color: #b91c1c; }

        /* Progress bar underneath */
        .finance-progress {
            height: 6px;
            border-radius: 99px;
            background: rgba(0,0,0,0.05);
            margin-top: 0.75rem;
            overflow: hidden;
        }

        .finance-progress-fill {
            height: 100%;
            border-radius: 99px;
            transition: width 1.2s ease;
        }

        .finance-card.revenue .finance-progress-fill { background: linear-gradient(90deg, #60a5fa, #3b82f6); }
        .finance-card.expense .finance-progress-fill { background: linear-gradient(90deg, #f87171, #ef4444); }

        /* Net result */
        .net-card {
            border-radius: 14px;
            padding: 1.1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .net-card.positive {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border: 1px solid #86efac;
        }

        .net-card.negative {
            background: linear-gradient(135deg, #fff1f2, #fee2e2);
            border: 1px solid #fca5a5;
        }

        .net-info {}

        .net-label {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 0.3rem;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .net-card.positive .net-label { color: #16a34a; }
        .net-card.negative .net-label { color: #dc2626; }

        .net-value {
            font-size: 1.35rem;
            font-weight: 900;
        }

        .net-card.positive .net-value { color: #15803d; }
        .net-card.negative .net-value { color: #b91c1c; }

        .net-icon {
            width: 48px; height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .net-card.positive .net-icon { background: #dcfce7; color: #16a34a; }
        .net-card.negative .net-icon { background: #fee2e2; color: #dc2626; }

        /* ── Orders Table ── */
        .orders-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .orders-table th {
            font-size: 0.66rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 0.6rem 1rem 0.7rem;
            border-bottom: 1.5px solid #f1f5f9;
            text-align: left;
        }

        .orders-table td {
            padding: 0.85rem 1rem;
            font-size: 0.82rem;
            font-weight: 600;
            color: #334155;
            border-bottom: 1px solid #f8fafc;
        }

        .orders-table tbody tr:last-child td { border-bottom: none; }
        .orders-table tbody tr { transition: background 0.2s; }
        .orders-table tbody tr:hover td { background: #f8faff; }

        .order-num {
            color: #3b82f6;
            font-weight: 800;
            font-size: 0.78rem;
        }

        .client-avatar {
            width: 32px; height: 32px;
            border-radius: 10px;
            background: linear-gradient(135deg, #dbeafe, #eff6ff);
            color: #1d4ed8;
            font-size: 0.72rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.6rem;
            flex-shrink: 0;
        }

        .sbadge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.28rem 0.6rem;
            border-radius: 50px;
            font-size: 0.66rem;
            font-weight: 700;
        }

        .sbadge-success { background: #dcfce7; color: #15803d; }
        .sbadge-warning { background: #fef9c3; color: #a16207; }
        .sbadge-danger  { background: #fee2e2; color: #b91c1c; }
        .sbadge-info    { background: #dbeafe; color: #1d4ed8; }

        /* ── Sidebar ── */
        .sidebar-col {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .bento-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            opacity: 0;
            animation: aUp 0.55s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .quick-link {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.85rem 1.25rem;
            text-decoration: none;
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.25s;
        }

        .quick-link:last-child { border-bottom: none; }

        .quick-link:hover {
            background: linear-gradient(90deg, #f8faff, #fff);
            padding-left: 1.5rem;
        }

        .ql-icon {
            width: 38px; height: 38px;
            border-radius: 11px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            color: #fff;
        }

        .ql-label { flex: 1; }
        .ql-title { font-size: 0.8rem; font-weight: 700; color: #0f172a; }
        .ql-desc  { font-size: 0.68rem; color: #94a3b8; font-weight: 500; }

        .ql-arrow {
            color: #cbd5e1;
            font-size: 0.7rem;
            transition: transform 0.2s, color 0.2s;
        }

        .quick-link:hover .ql-arrow { color: #3b82f6; transform: translateX(3px); }

        /* ── Summary card ── */
        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 0;
            border-bottom: 1px solid #f8fafc;
        }

        .summary-row:last-child { border-bottom: none; }

        .summary-label {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
        }

        .summary-icon {
            width: 24px; height: 24px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
        }

        .summary-val {
            font-size: 0.78rem;
            font-weight: 800;
            color: #0f172a;
        }

        /* Net mini card in sidebar */
        .net-mini {
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            margin-top: 0.75rem;
        }

        .net-mini.positive { background: linear-gradient(135deg, #f0fdf4, #dcfce7); border: 1px solid #86efac; }
        .net-mini.negative { background: linear-gradient(135deg, #fef2f2, #fee2e2); border: 1px solid #fca5a5; }

        .net-mini-label {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 0.3rem;
        }

        .net-mini.positive .net-mini-label { color: #16a34a; }
        .net-mini.negative .net-mini-label { color: #dc2626; }

        .net-mini-value { font-size: 1.15rem; font-weight: 900; }
        .net-mini.positive .net-mini-value { color: #15803d; }
        .net-mini.negative .net-mini-value { color: #b91c1c; }

        /* ══════════════════════════════
           ANIMATIONS
        ══════════════════════════════ */
        @keyframes aUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .d1 { animation-delay: 0.3s; }
        .d2 { animation-delay: 0.38s; }
        .d3 { animation-delay: 0.46s; }
        .d4 { animation-delay: 0.54s; }

        /* ══════════════════════════════
           RESPONSIVE
        ══════════════════════════════ */
        @media (max-width: 1200px) {
            .kpi-grid { grid-template-columns: repeat(3, 1fr); }
        }

        @media (max-width: 1100px) {
            .main-grid { grid-template-columns: 1fr; }
            .sidebar-col {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .kpi-grid { grid-template-columns: repeat(2, 1fr); }
            .finance-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 640px) {
            .kpi-grid { grid-template-columns: 1fr 1fr; }
            .db-hero { padding: 1.5rem; border-radius: 18px; }
            .db-greeting h1 { font-size: 1.35rem; }
            .db-hero-actions { width: 100%; }
            .sidebar-col { grid-template-columns: 1fr; }
            .net-card { flex-direction: column; text-align: center; gap: 0.75rem; }
        }
    </style>

    {{-- ══════ HERO ══════ --}}
    <div class="db-hero">
        <div class="db-hero-orb db-orb-1"></div>
        <div class="db-hero-orb db-orb-2"></div>
        <div class="db-hero-orb db-orb-3"></div>
        <div class="db-hero-inner">
            <div class="db-greeting">
                <div class="db-greeting-badge">
                    <i class="bi bi-lightning-charge-fill"></i>
                    Vue d'ensemble · {{ date('Y') }}
                </div>
                <h1>Bonjour, {{ Auth::check() ? Auth::user()->name : 'Admin' }} 👋</h1>
                <p><i class="bi bi-calendar3 me-1"></i>{{ now()->isoFormat('dddd D MMMM YYYY') }} · Voici l'état de vos activités</p>
            </div>
            <div class="db-hero-actions">
                <a href="{{ route('clients.create') }}" class="btn-hero-primary">
                    <i class="bi bi-person-plus-fill"></i> Nouveau Client
                </a>
                <a href="{{ route('commandes.create') }}" class="btn-hero-solid">
                    <i class="bi bi-plus-lg"></i> Nouvelle Commande
                </a>
            </div>
        </div>
    </div>

    {{-- ══════ KPI CARDS ══════ --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-head">
                <span class="kpi-label">Chiffre d'affaires</span>
                <div class="kpi-icon"><i class="bi bi-graph-up-arrow"></i></div>
            </div>
            <div class="kpi-value">{{ number_format($totalCA, 0, ',', ' ') }} <small>Dh</small></div>
            <div class="kpi-sub" style="color:#3b82f6;"><i class="bi bi-arrow-up-right-circle-fill"></i> Total facturé</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-head">
                <span class="kpi-label">Commandes clients</span>
                <div class="kpi-icon"><i class="bi bi-bag-check-fill"></i></div>
            </div>
            <div class="kpi-value">{{ $totalCommandes }}</div>
            <div class="kpi-sub" style="color:#8b5cf6;"><i class="bi bi-arrow-right-circle-fill"></i> Commandes enregistrées</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-head">
                <span class="kpi-label">Clients enregistrés</span>
                <div class="kpi-icon"><i class="bi bi-people-fill"></i></div>
            </div>
            <div class="kpi-value">{{ $totalClients }}</div>
            <div class="kpi-sub" style="color:#f59e0b;"><i class="bi bi-person-check-fill"></i> Base de clients active</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-head">
                <span class="kpi-label">Produits catalogués</span>
                <div class="kpi-icon"><i class="bi bi-box-seam-fill"></i></div>
            </div>
            <div class="kpi-value">{{ $totalProduits }}</div>
            <div class="kpi-sub" style="color:#10b981;"><i class="bi bi-box-fill"></i> Total inventaire</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-head">
                <span class="kpi-label">Dépenses fournisseurs</span>
                <div class="kpi-icon"><i class="bi bi-truck-flatbed"></i></div>
            </div>
            <div class="kpi-value">{{ number_format($totalDepenses, 0, ',', ' ') }} <small>Dh</small></div>
            <div class="kpi-sub" style="color:#ef4444;"><i class="bi bi-arrow-down-right-circle-fill"></i> Total achats</div>
        </div>
    </div>

    {{-- ══════ MAIN GRID ══════ --}}
    <div class="main-grid">

        {{-- Left column --}}
        <div style="display:flex;flex-direction:column;gap:1.25rem;">

            {{-- Monthly Sales Chart --}}
            <div class="panel d1">
                <div class="panel-head">
                    <h3 class="panel-title">
                        <i class="bi bi-bar-chart-line-fill" style="color:#3b82f6;"></i>
                        Ventes Mensuelles ({{ date('Y') }})
                    </h3>
                    <span class="chart-total-badge">
                        <i class="bi bi-cash-stack"></i>
                        Total: {{ number_format(collect($monthlyData)->sum('total'), 0, ',', ' ') }} Dh
                    </span>
                </div>
                <div class="panel-body">
                    <div class="chart-legend">
                        <div class="chart-legend-item">
                            <span class="chart-legend-dot" style="background: #3b82f6;"></span>
                            Ventes mensuelles
                        </div>
                        <div class="chart-legend-item">
                            <span class="chart-legend-dot" style="background: rgba(59,130,246,0.15);"></span>
                            Zone de tendance
                        </div>
                    </div>
                    <div class="chart-canvas-wrapper">
                        <canvas id="monthlySalesChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Finance summary --}}
            <div class="panel d1">
                <div class="panel-head">
                    <h3 class="panel-title">
                        <i class="bi bi-pie-chart-fill" style="color:#3b82f6;"></i>
                        Bilan Financier
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="finance-grid">
                        <div class="finance-card revenue">
                            <div class="finance-card-icon">
                                <i class="bi bi-arrow-up-circle-fill"></i>
                            </div>
                            <div class="finance-card-label">Revenus totaux</div>
                            <div class="finance-card-value">{{ number_format($totalCA, 0, ',', ' ') }} Dh</div>
                            <div class="finance-progress">
                                <div class="finance-progress-fill" style="width:{{ ($totalCA / $maxBar) * 100 }}%;"></div>
                            </div>
                        </div>

                        <div class="finance-card expense">
                            <div class="finance-card-icon">
                                <i class="bi bi-arrow-down-circle-fill"></i>
                            </div>
                            <div class="finance-card-label">Dépenses totales</div>
                            <div class="finance-card-value">{{ number_format($totalDepenses, 0, ',', ' ') }} Dh</div>
                            <div class="finance-progress">
                                <div class="finance-progress-fill" style="width:{{ ($totalDepenses / $maxBar) * 100 }}%;"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Net result --}}
                    @php $net = $totalCA - $totalDepenses; @endphp
                    <div class="net-card {{ $net >= 0 ? 'positive' : 'negative' }}">
                        <div class="net-info">
                            <div class="net-label">
                                <i class="bi bi-{{ $net >= 0 ? 'trophy-fill' : 'exclamation-triangle-fill' }}"></i>
                                Bénéfice net estimé
                            </div>
                            <div class="net-value">
                                {{ $net >= 0 ? '+' : '' }}{{ number_format($net, 0, ',', ' ') }} Dh
                            </div>
                        </div>
                        <div class="net-icon">
                            <i class="bi bi-{{ $net >= 0 ? 'emoji-smile-fill' : 'emoji-frown-fill' }}"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent orders --}}
            <div class="panel d2">
                <div class="panel-head">
                    <h3 class="panel-title">
                        <i class="bi bi-clock-history" style="color:#8b5cf6;"></i>
                        Commandes Récentes
                    </h3>
                    <a href="{{ route('commandes.index') }}" class="panel-link">Voir tout <i class="bi bi-arrow-right"></i></a>
                </div>
                <div style="overflow-x:auto;">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>N° Commande</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentCommandes as $cmd)
                                <tr>
                                    <td><span class="order-num">#{{ $cmd->numero_commande }}</span></td>
                                    <td>
                                        <div style="display:flex;align-items:center;">
                                            <span class="client-avatar">{{ strtoupper(substr(optional($cmd->client)->nom_entreprise ?? 'C', 0, 1)) }}</span>
                                            <span>{{ optional($cmd->client)->nom_entreprise ?? 'Client Anonyme' }}</span>
                                        </div>
                                    </td>
                                    <td style="color:#94a3b8;">{{ \Carbon\Carbon::parse($cmd->date_commande)->format('d M Y') }}</td>
                                    <td style="font-weight:800;">{{ number_format($cmd->montant_total, 2, ',', ' ') }} Dh</td>
                                    <td>
                                        @php $s = strtolower($cmd->statut ?? ''); @endphp
                                        @if($s === 'livrée' || $s == 'livree')
                                            <span class="sbadge sbadge-success"><i class="bi bi-check-circle-fill"></i> Livrée</span>
                                        @elseif($s === 'en cours')
                                            <span class="sbadge sbadge-warning"><i class="bi bi-clock-fill"></i> En cours</span>
                                        @elseif($s === 'annulée' || $s == 'annulee')
                                            <span class="sbadge sbadge-danger"><i class="bi bi-x-circle-fill"></i> Annulée</span>
                                        @else
                                            <span class="sbadge sbadge-info"><i class="bi bi-info-circle-fill"></i> {{ $cmd->statut }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align:center;color:#94a3b8;padding:3rem;">
                                        <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:.5rem;color:#cbd5e1;"></i>
                                        <span style="font-weight:700;color:#64748b;">Aucune commande récente</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>{{-- /left --}}

        {{-- Right sidebar --}}
        <div class="sidebar-col">

            {{-- Quick actions --}}
            <div class="bento-card d3">
                <div class="panel-head">
                    <h3 class="panel-title">
                        <i class="bi bi-lightning-charge-fill" style="color:#f59e0b;"></i>
                        Raccourcis
                    </h3>
                </div>
                <div>
                    <a href="{{ route('clients.create') }}" class="quick-link">
                        <div class="ql-icon" style="background:linear-gradient(135deg,#f59e0b,#d97706);box-shadow:0 4px 12px rgba(245,158,11,.2);">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <div class="ql-label">
                            <div class="ql-title">Nouveau Client</div>
                            <div class="ql-desc">Ajouter un partenaire</div>
                        </div>
                        <i class="bi bi-chevron-right ql-arrow"></i>
                    </a>
                    <a href="{{ route('commandes.create') }}" class="quick-link">
                        <div class="ql-icon" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8);box-shadow:0 4px 12px rgba(59,130,246,.2);">
                            <i class="bi bi-bag-plus-fill"></i>
                        </div>
                        <div class="ql-label">
                            <div class="ql-title">Nouvelle Commande</div>
                            <div class="ql-desc">Créer une vente</div>
                        </div>
                        <i class="bi bi-chevron-right ql-arrow"></i>
                    </a>
                    <a href="{{ route('produits.create') }}" class="quick-link">
                        <div class="ql-icon" style="background:linear-gradient(135deg,#10b981,#059669);box-shadow:0 4px 12px rgba(16,185,129,.2);">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                        <div class="ql-label">
                            <div class="ql-title">Nouveau Produit</div>
                            <div class="ql-desc">Ajouter à l'inventaire</div>
                        </div>
                        <i class="bi bi-chevron-right ql-arrow"></i>
                    </a>
                    <a href="{{ route('stock.create') }}" class="quick-link">
                        <div class="ql-icon" style="background:linear-gradient(135deg,#8b5cf6,#6d28d9);box-shadow:0 4px 12px rgba(139,92,246,.2);">
                            <i class="bi bi-boxes"></i>
                        </div>
                        <div class="ql-label">
                            <div class="ql-title">Mouvement Stock</div>
                            <div class="ql-desc">Entrée / Sortie</div>
                        </div>
                        <i class="bi bi-chevron-right ql-arrow"></i>
                    </a>
                    <a href="{{ route('factures.index') }}" class="quick-link">
                        <div class="ql-icon" style="background:linear-gradient(135deg,#ef4444,#dc2626);box-shadow:0 4px 12px rgba(239,68,68,.2);">
                            <i class="bi bi-receipt-cutoff"></i>
                        </div>
                        <div class="ql-label">
                            <div class="ql-title">Factures</div>
                            <div class="ql-desc">Gérer la facturation</div>
                        </div>
                        <i class="bi bi-chevron-right ql-arrow"></i>
                    </a>
                    <a href="{{ route('paiements.index') }}" class="quick-link">
                        <div class="ql-icon" style="background:linear-gradient(135deg,#06b6d4,#0891b2);box-shadow:0 4px 12px rgba(6,182,212,.2);">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div class="ql-label">
                            <div class="ql-title">Paiements</div>
                            <div class="ql-desc">Suivi des encaissements</div>
                        </div>
                        <i class="bi bi-chevron-right ql-arrow"></i>
                    </a>
                </div>
            </div>

            {{-- Summary stats box --}}
            <div class="bento-card d4">
                <div class="panel-head">
                    <h3 class="panel-title">
                        <i class="bi bi-activity" style="color:#10b981;"></i>
                        Résumé
                    </h3>
                </div>
                <div class="panel-body" style="padding-top:.6rem;">
                    @php
                        $summaryItems = [
                            ['label' => 'Chiffre d\'affaires', 'val' => number_format($totalCA, 0, ',', ' ') . ' Dh', 'color' => '#3b82f6', 'bg' => '#eff6ff', 'icon' => 'bi-graph-up'],
                            ['label' => 'Dépenses totales', 'val' => number_format($totalDepenses, 0, ',', ' ') . ' Dh', 'color' => '#ef4444', 'bg' => '#fef2f2', 'icon' => 'bi-graph-down'],
                            ['label' => 'Nb. commandes', 'val' => $totalCommandes, 'color' => '#8b5cf6', 'bg' => '#f5f3ff', 'icon' => 'bi-bag-check'],
                            ['label' => 'Nb. clients', 'val' => $totalClients, 'color' => '#f59e0b', 'bg' => '#fffbeb', 'icon' => 'bi-people'],
                            ['label' => 'Nb. produits', 'val' => $totalProduits, 'color' => '#10b981', 'bg' => '#f0fdf4', 'icon' => 'bi-box-seam'],
                        ];
                    @endphp
                    @foreach($summaryItems as $item)
                        <div class="summary-row">
                            <span class="summary-label">
                                <span class="summary-icon" style="background:{{ $item['bg'] }};color:{{ $item['color'] }};">
                                    <i class="bi {{ $item['icon'] }}"></i>
                                </span>
                                {{ $item['label'] }}
                            </span>
                            <span class="summary-val">{{ $item['val'] }}</span>
                        </div>
                    @endforeach
                    <div class="net-mini {{ $net >= 0 ? 'positive' : 'negative' }}">
                        <div class="net-mini-label">
                            <i class="bi bi-{{ $net >= 0 ? 'trophy-fill' : 'exclamation-triangle-fill' }} me-1"></i>
                            Bénéfice net
                        </div>
                        <div class="net-mini-value">
                            {{ $net >= 0 ? '+' : '' }}{{ number_format($net, 0, ',', ' ') }} Dh
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- /sidebar --}}

    </div>{{-- /main-grid --}}

    {{-- ══════ CHART.JS ══════ --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('monthlySalesChart').getContext('2d');
        
        const labels = @json(collect($monthlyData)->pluck('month'));
        const dataValues = @json(collect($monthlyData)->pluck('total'));

        // Create gradient fill
        const gradient = ctx.createLinearGradient(0, 0, 0, 280);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.22)');
        gradient.addColorStop(0.5, 'rgba(59, 130, 246, 0.06)');
        gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Ventes (Dh)',
                    data: dataValues,
                    borderColor: '#3b82f6',
                    backgroundColor: gradient,
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 2.5,
                    pointHoverBackgroundColor: '#3b82f6',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 3,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#94a3b8',
                        titleFont: { size: 11, weight: '600' },
                        bodyColor: '#fff',
                        bodyFont: { size: 13, weight: '700' },
                        padding: { top: 10, bottom: 10, left: 14, right: 14 },
                        cornerRadius: 10,
                        displayColors: false,
                        callbacks: {
                            title: (items) => items[0].label,
                            label: (item) => new Intl.NumberFormat('fr-FR').format(item.raw) + ' Dh'
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8', font: { size: 11, weight: '600' } },
                        border: { display: false },
                    },
                    y: {
                        grid: { color: 'rgba(226, 232, 240, 0.5)', drawBorder: false },
                        ticks: {
                            color: '#94a3b8',
                            font: { size: 11, weight: '600' },
                            callback: (v) => v >= 1000 ? (v/1000) + 'k' : v,
                            maxTicksLimit: 6,
                        },
                        border: { display: false },
                        beginAtZero: true,
                    }
                },
                animation: { duration: 1200, easing: 'easeOutQuart' }
            }
        });
    });
    </script>

@endsection