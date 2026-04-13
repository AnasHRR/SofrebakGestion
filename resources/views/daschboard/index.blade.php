@extends('_layout')
@section('title', 'Dashboard - Sofrebak')
@section('content')

    @php
        use Carbon\Carbon;

        $totalCA = \App\Models\Factures::sum('montant_total') ?? 0;
        $totalCommandes = \App\Models\CommandeClient::count();
        $totalClients = \App\Models\clients::count();
        $totalProduits = \App\Models\Produits::count();
        $totalDepenses = \App\Models\commandesFournisseurs::sum('montant_total') ?? 0;
        $benefice = $totalCA - $totalDepenses;

        $recentCommandes = \App\Models\CommandeClient::with('client')
            ->orderBy('date_commande', 'desc')
            ->take(7)
            ->get();

        $maxBar = max($totalCA, $totalDepenses, 1);
    @endphp

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        /* ══════════════════════════════
           HERO BANNER
        ══════════════════════════════ */
        .db-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 40%, #1e3a6e 75%, #1d4ed8 100%);
            border-radius: 24px;
            padding: 2rem 2.5rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .db-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 400px 300px at 85% 30%, rgba(59, 130, 246, 0.25), transparent),
                radial-gradient(ellipse 250px 200px at 15% 70%, rgba(99, 102, 241, 0.12), transparent);
        }

        .db-hero-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(50px);
            pointer-events: none;
        }

        .db-orb-1 {
            width: 200px;
            height: 200px;
            background: rgba(59, 130, 246, 0.15);
            top: -60px;
            right: 5%;
        }

        .db-orb-2 {
            width: 120px;
            height: 120px;
            background: rgba(99, 102, 241, 0.1);
            bottom: -30px;
            right: 25%;
        }

        .db-hero-inner {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .db-greeting {}

        .db-greeting-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            background: rgba(59, 130, 246, 0.2);
            border: 1px solid rgba(59, 130, 246, 0.35);
            color: #bfdbfe;
            border-radius: 50px;
            padding: 0.22rem 0.75rem;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 0.6rem;
        }

        .db-greeting h1 {
            font-size: 1.75rem;
            font-weight: 900;
            margin: 0 0 0.3rem;
            background: linear-gradient(135deg, #fff, rgba(255, 255, 255, 0.75));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .db-greeting p {
            color: rgba(255, 255, 255, 0.45);
            font-size: 0.82rem;
            margin: 0;
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
            padding: 0.6rem 1.25rem;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-hero-primary:hover {
            background: rgba(255, 255, 255, 0.22);
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-hero-solid {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.6rem 1.25rem;
            background: #3b82f6;
            border: none;
            color: #fff;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 14px rgba(59, 130, 246, 0.4);
        }

        .btn-hero-solid:hover {
            background: #2563eb;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.5);
        }

        /* ══════════════════════════════
           KPI CARDS
        ══════════════════════════════ */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.75rem;
        }

        .kpi-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            opacity: 0;
            animation: aUp 0.55s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .kpi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
        }

        .kpi-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle at top right, var(--kc), transparent 70%);
            opacity: 0.35;
            transform: translate(25%, -25%);
            border-radius: 50%;
            pointer-events: none;
        }

        .kpi-card:nth-child(1) {
            --kc: #93c5fd;
            animation-delay: 0.05s;
        }

        .kpi-card:nth-child(2) {
            --kc: #c4b5fd;
            animation-delay: 0.1s;
        }

        .kpi-card:nth-child(3) {
            --kc: #fcd34d;
            animation-delay: 0.15s;
        }

        .kpi-card:nth-child(4) {
            --kc: #6ee7b7;
            animation-delay: 0.2s;
        }

        .kpi-card:nth-child(5) {
            --kc: #fca5a5;
            animation-delay: 0.25s;
        }

        .kpi-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .kpi-label {
            font-size: 0.7rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .kpi-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #fff;
            flex-shrink: 0;
        }

        .kpi-card:nth-child(1) .kpi-icon {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.35);
        }

        .kpi-card:nth-child(2) .kpi-icon {
            background: linear-gradient(135deg, #8b5cf6, #6d28d9);
            box-shadow: 0 6px 16px rgba(139, 92, 246, 0.35);
        }

        .kpi-card:nth-child(3) .kpi-icon {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            box-shadow: 0 6px 16px rgba(245, 158, 11, 0.35);
        }

        .kpi-card:nth-child(4) .kpi-icon {
            background: linear-gradient(135deg, #10b981, #059669);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.35);
        }

        .kpi-card:nth-child(5) .kpi-icon {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.35);
        }

        .kpi-value {
            font-size: 1.75rem;
            font-weight: 900;
            color: #0f172a;
            line-height: 1;
            margin-bottom: 0.4rem;
        }

        .kpi-sub {
            font-size: 0.72rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* ══════════════════════════════
           MAIN GRID
        ══════════════════════════════ */
        .main-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
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
            padding: 1.4rem 1.75rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .panel-title {
            font-size: 0.95rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        .panel-link {
            font-size: 0.78rem;
            font-weight: 600;
            color: #3b82f6;
            text-decoration: none;
        }

        .panel-link:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .panel-body {
            padding: 1.4rem 1.75rem;
        }

        /* ── Finance Bars ── */
        .finance-item {
            margin-bottom: 1.5rem;
        }

        .finance-item:last-child {
            margin-bottom: 0;
        }

        .finance-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .finance-label {
            font-size: 0.78rem;
            font-weight: 600;
            color: #475569;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .finance-label i {
            font-size: 0.7rem;
        }

        .finance-amount {
            font-size: 0.82rem;
            font-weight: 800;
        }

        .finance-bar {
            height: 8px;
            border-radius: 99px;
            overflow: hidden;
            background: #f1f5f9;
        }

        .finance-fill {
            height: 100%;
            border-radius: 99px;
            transition: width 1s ease;
        }

        /* ── Orders Table ── */
        .orders-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .orders-table th {
            font-size: 0.68rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 0 1rem 0.8rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .orders-table td {
            padding: 0.85rem 1rem;
            font-size: 0.82rem;
            font-weight: 600;
            color: #334155;
            border-bottom: 1px solid #f8fafc;
        }

        .orders-table tbody tr:last-child td {
            border-bottom: none;
        }

        .orders-table tbody tr {
            transition: background 0.2s;
        }

        .orders-table tbody tr:hover td {
            background: #f8fafc;
        }

        .order-num {
            color: #3b82f6;
            font-weight: 700;
        }

        .client-avatar {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: linear-gradient(135deg, #dbeafe, #eff6ff);
            color: #1d4ed8;
            font-size: 0.72rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
            flex-shrink: 0;
        }

        .sbadge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.3rem 0.65rem;
            border-radius: 50px;
            font-size: 0.68rem;
            font-weight: 700;
        }

        .sbadge-success {
            background: #dcfce7;
            color: #15803d;
        }

        .sbadge-warning {
            background: #fef9c3;
            color: #a16207;
        }

        .sbadge-danger {
            background: #fee2e2;
            color: #b91c1c;
        }

        .sbadge-info {
            background: #dbeafe;
            color: #1d4ed8;
        }

        /* ── Sidebar Quicklinks ── */
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
            gap: 0.9rem;
            padding: 0.9rem 1.25rem;
            text-decoration: none;
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.2s, transform 0.2s;
        }

        .quick-link:last-child {
            border-bottom: none;
        }

        .quick-link:hover {
            background: #f0f6ff;
            transform: translateX(4px);
        }

        .ql-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: #fff;
        }

        .ql-label {
            flex: 1;
        }

        .ql-title {
            font-size: 0.82rem;
            font-weight: 700;
            color: #0f172a;
        }

        .ql-desc {
            font-size: 0.7rem;
            color: #94a3b8;
        }

        .ql-arrow {
            color: #cbd5e1;
            font-size: 0.75rem;
        }

        /* ── Net Result ── */
        .net-card {
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            text-align: center;
        }

        .net-card.positive {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border: 1px solid #86efac;
        }

        .net-card.negative {
            background: linear-gradient(135deg, #fff1f2, #fee2e2);
            border: 1px solid #fca5a5;
        }

        .net-label {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.4rem;
        }

        .net-card.positive .net-label {
            color: #16a34a;
        }

        .net-card.negative .net-label {
            color: #dc2626;
        }

        .net-value {
            font-size: 1.5rem;
            font-weight: 900;
        }

        .net-card.positive .net-value {
            color: #15803d;
        }

        .net-card.negative .net-value {
            color: #b91c1c;
        }

        /* ══════════════════════════════
           ANIMATIONS
        ══════════════════════════════ */
        @keyframes aUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }

            from {
                opacity: 0;
                transform: translateY(20px);
            }
        }

        .d1 {
            animation-delay: 0.3s;
        }

        .d2 {
            animation-delay: 0.38s;
        }

        .d3 {
            animation-delay: 0.46s;
        }

        .d4 {
            animation-delay: 0.54s;
        }

        /* ══════════════════════════════
           RESPONSIVE
        ══════════════════════════════ */
        @media (max-width: 1100px) {
            .main-grid {
                grid-template-columns: 1fr;
            }

            .sidebar-col {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {
            .kpi-grid {
                grid-template-columns: 1fr 1fr;
            }

            .db-hero {
                padding: 1.5rem;
            }

            .db-greeting h1 {
                font-size: 1.35rem;
            }

            .db-hero-actions {
                width: 100%;
            }

            .sidebar-col {
                grid-template-columns: 1fr;
            }
        }
    </style>

    {{-- ══════ HERO ══════ --}}
    <div class="db-hero">
        <div class="db-hero-orb db-orb-1"></div>
        <div class="db-hero-orb db-orb-2"></div>
        <div class="db-hero-inner">
            <div class="db-greeting">
                <div class="db-greeting-badge">
                    <i class="bi bi-lightning-charge-fill"></i>
                    Vue d'ensemble
                </div>
                <h1>Bonjour, {{ Auth::check() ? Auth::user()->name : 'Admin' }} 👋</h1>
                <p>{{ now()->isoFormat('dddd D MMMM YYYY') }} · Voici l'état de vos activités</p>
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
            <div class="kpi-value">{{ number_format($totalCA, 0, ',', ' ') }}<small
                    style="font-size:1rem;font-weight:600;color:#94a3b8;"> Dh</small></div>
            <div class="kpi-sub" style="color:#3b82f6;"><i class="bi bi-arrow-up-right-circle-fill"></i> Total facturé</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-head">
                <span class="kpi-label">Commandes clients</span>
                <div class="kpi-icon"><i class="bi bi-bag-check-fill"></i></div>
            </div>
            <div class="kpi-value">{{ $totalCommandes }}</div>
            <div class="kpi-sub" style="color:#8b5cf6;"><i class="bi bi-arrow-right-circle-fill"></i> Commandes enregistrées
            </div>
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
            <div class="kpi-value">{{ number_format($totalDepenses, 0, ',', ' ') }}<small
                    style="font-size:1rem;font-weight:600;color:#94a3b8;"> Dh</small></div>
            <div class="kpi-sub" style="color:#ef4444;"><i class="bi bi-arrow-down-right-circle-fill"></i> Total achats
            </div>
        </div>
    </div>

    {{-- ══════ MAIN GRID ══════ --}}
    <div class="main-grid">

        {{-- Left column --}}
        <div style="display:flex;flex-direction:column;gap:1.25rem;">

            {{-- Finance summary --}}
            <div class="panel d1">
                <div class="panel-head">
                    <h3 class="panel-title"><i class="bi bi-bar-chart-fill me-2" style="color:#3b82f6;"></i>Bilan Financier
                    </h3>
                </div>
                <div class="panel-body">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem;">

                        <div class="finance-item">
                            <div class="finance-row">
                                <span class="finance-label" style="color:#3b82f6;"><i
                                        class="bi bi-arrow-up-circle-fill"></i> Revenus</span>
                                <span class="finance-amount"
                                    style="color:#3b82f6;">{{ number_format($totalCA, 0, ',', ' ') }} Dh</span>
                            </div>
                            <div class="finance-bar">
                                <div class="finance-fill"
                                    style="width:{{ ($totalCA / $maxBar) * 100 }}%;background:linear-gradient(90deg,#60a5fa,#3b82f6);">
                                </div>
                            </div>
                        </div>

                        <div class="finance-item">
                            <div class="finance-row">
                                <span class="finance-label" style="color:#ef4444;"><i
                                        class="bi bi-arrow-down-circle-fill"></i> Dépenses</span>
                                <span class="finance-amount"
                                    style="color:#ef4444;">{{ number_format($totalDepenses, 0, ',', ' ') }} Dh</span>
                            </div>
                            <div class="finance-bar">
                                <div class="finance-fill"
                                    style="width:{{ ($totalDepenses / $maxBar) * 100 }}%;background:linear-gradient(90deg,#f87171,#ef4444);">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Net result --}}
                    @php $net = $totalCA - $totalDepenses; @endphp
                    <div class="net-card {{ $net >= 0 ? 'positive' : 'negative' }}">
                        <div class="net-label">
                            <i class="bi bi-{{ $net >= 0 ? 'emoji-smile-fill' : 'emoji-frown-fill' }} me-1"></i>
                            Bénéfice net estimé
                        </div>
                        <div class="net-value">
                            {{ $net >= 0 ? '+' : '' }}{{ number_format($net, 0, ',', ' ') }} Dh
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent orders --}}
            <div class="panel d2">
                <div class="panel-head">
                    <h3 class="panel-title"><i class="bi bi-clock-history me-2" style="color:#8b5cf6;"></i>Commandes
                        Récentes</h3>
                    <a href="{{ route('commandes.index') }}" class="panel-link">Voir tout →</a>
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
                                            <span
                                                class="client-avatar">{{ strtoupper(substr(optional($cmd->client)->nom_entreprise ?? 'C', 0, 1)) }}</span>
                                            <span>{{ optional($cmd->client)->nom_entreprise ?? 'Client Anonyme' }}</span>
                                        </div>
                                    </td>
                                    <td style="color:#94a3b8;">{{ \Carbon\Carbon::parse($cmd->date_commande)->format('d M Y') }}
                                    </td>
                                    <td style="font-weight:800;">{{ number_format($cmd->montant_total, 2, ',', ' ') }} Dh</td>
                                    <td>
                                        @php $s = strtolower($cmd->statut ?? ''); @endphp
                                        @if($s === 'livrée' || $s == 'livree')
                                            <span class="sbadge sbadge-success"><i class="bi bi-check-circle-fill"></i>
                                                Livrée</span>
                                        @elseif($s === 'en cours')
                                            <span class="sbadge sbadge-warning"><i class="bi bi-clock-fill"></i> En cours</span>
                                        @elseif($s === 'annulée' || $s == 'annulee')
                                            <span class="sbadge sbadge-danger"><i class="bi bi-x-circle-fill"></i> Annulée</span>
                                        @else
                                            <span class="sbadge sbadge-info"><i class="bi bi-info-circle-fill"></i>
                                                {{ $cmd->statut }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align:center;color:#94a3b8;padding:2rem;">
                                        <i class="bi bi-inbox" style="font-size:1.5rem;display:block;margin-bottom:.5rem;"></i>
                                        Aucune commande récente
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
                    <h3 class="panel-title"><i class="bi bi-lightning-charge-fill me-2"
                            style="color:#f59e0b;"></i>Raccourcis</h3>
                </div>
                <div>
                    <a href="{{ route('clients.create') }}" class="quick-link">
                        <div class="ql-icon"
                            style="background:linear-gradient(135deg,#f59e0b,#d97706);box-shadow:0 4px 12px rgba(245,158,11,.25);">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <div class="ql-label">
                            <div class="ql-title">Nouveau Client</div>
                            <div class="ql-desc">Ajouter un partenaire</div>
                        </div>
                        <i class="bi bi-chevron-right ql-arrow"></i>
                    </a>
                    <a href="{{ route('commandes.create') }}" class="quick-link">
                        <div class="ql-icon"
                            style="background:linear-gradient(135deg,#3b82f6,#1d4ed8);box-shadow:0 4px 12px rgba(59,130,246,.25);">
                            <i class="bi bi-bag-plus-fill"></i>
                        </div>
                        <div class="ql-label">
                            <div class="ql-title">Nouvelle Commande</div>
                            <div class="ql-desc">Créer une vente</div>
                        </div>
                        <i class="bi bi-chevron-right ql-arrow"></i>
                    </a>
                    <a href="{{ route('produits.create') }}" class="quick-link">
                        <div class="ql-icon"
                            style="background:linear-gradient(135deg,#10b981,#059669);box-shadow:0 4px 12px rgba(16,185,129,.25);">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                        <div class="ql-label">
                            <div class="ql-title">Nouveau Produit</div>
                            <div class="ql-desc">Ajouter à l'inventaire</div>
                        </div>
                        <i class="bi bi-chevron-right ql-arrow"></i>
                    </a>
                    <a href="{{ route('stock.create') }}" class="quick-link">
                        <div class="ql-icon"
                            style="background:linear-gradient(135deg,#8b5cf6,#6d28d9);box-shadow:0 4px 12px rgba(139,92,246,.25);">
                            <i class="bi bi-boxes"></i>
                        </div>
                        <div class="ql-label">
                            <div class="ql-title">Mouvement Stock</div>
                            <div class="ql-desc">Entrée / Sortie</div>
                        </div>
                        <i class="bi bi-chevron-right ql-arrow"></i>
                    </a>
                    <a href="{{ route('factures.index') }}" class="quick-link">
                        <div class="ql-icon"
                            style="background:linear-gradient(135deg,#ef4444,#dc2626);box-shadow:0 4px 12px rgba(239,68,68,.25);">
                            <i class="bi bi-receipt-cutoff"></i>
                        </div>
                        <div class="ql-label">
                            <div class="ql-title">Factures</div>
                            <div class="ql-desc">Gérer la facturation</div>
                        </div>
                        <i class="bi bi-chevron-right ql-arrow"></i>
                    </a>
                </div>
            </div>

            {{-- Summary stats box --}}
            <div class="bento-card d4">
                <div class="panel-head">
                    <h3 class="panel-title"><i class="bi bi-activity me-2" style="color:#10b981;"></i>Résumé</h3>
                </div>
                <div class="panel-body" style="padding-top:.75rem;">
                    @php
                        $items = [
                            ['label' => 'Chiffre d\'affaires', 'val' => number_format($totalCA, 0, ',', ' ') . ' Dh', 'color' => '#3b82f6', 'icon' => 'bi-graph-up'],
                            ['label' => 'Dépenses totales', 'val' => number_format($totalDepenses, 0, ',', ' ') . ' Dh', 'color' => '#ef4444', 'icon' => 'bi-graph-down'],
                            ['label' => 'Nb. commandes', 'val' => $totalCommandes, 'color' => '#8b5cf6', 'icon' => 'bi-bag-check'],
                            ['label' => 'Nb. clients', 'val' => $totalClients, 'color' => '#f59e0b', 'icon' => 'bi-people'],
                            ['label' => 'Nb. produits', 'val' => $totalProduits, 'color' => '#10b981', 'icon' => 'bi-box-seam'],
                        ];
                    @endphp
                    @foreach($items as $item)
                        <div
                            style="display:flex;justify-content:space-between;align-items:center;padding:.55rem 0;border-bottom:1px solid #f8fafc;">
                            <span
                                style="display:flex;align-items:center;gap:.4rem;font-size:.75rem;color:#64748b;font-weight:500;">
                                <i class="bi {{ $item['icon'] }}" style="color:{{ $item['color'] }};font-size:.7rem;"></i>
                                {{ $item['label'] }}
                            </span>
                            <span style="font-size:.78rem;font-weight:800;color:#0f172a;">{{ $item['val'] }}</span>
                        </div>
                    @endforeach
                    <div style="padding-top:.75rem;">
                        <div class="net-card {{ $net >= 0 ? 'positive' : 'negative' }}">
                            <div class="net-label">Bénéfice net</div>
                            <div class="net-value" style="font-size:1.2rem;">
                                {{ $net >= 0 ? '+' : '' }}{{ number_format($net, 0, ',', ' ') }} Dh</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- /sidebar --}}

    </div>{{-- /main-grid --}}

@endsection