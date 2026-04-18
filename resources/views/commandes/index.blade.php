@extends('_layout')

@section('title', 'Commandes')

@section('content')

<style>
    /* ── Page Header ── */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.6rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-header-left h2 {
        font-size: 1.35rem;
        font-weight: 800;
        color: #0f1e4a;
        margin: 0;
        letter-spacing: -0.4px;
    }

    .page-header-left p {
        font-size: 0.82rem;
        color: #64748b;
        margin: 0.2rem 0 0;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
        color: #fff;
        font-size: 0.84rem;
        font-weight: 700;
        padding: 0.55rem 1.1rem;
        border-radius: 10px;
        text-decoration: none;
        box-shadow: 0 4px 14px rgba(29,78,216,0.35);
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .btn-add:hover {
        box-shadow: 0 6px 20px rgba(29,78,216,0.5);
        transform: translateY(-1px);
        color: #fff;
    }

    /* ── Stats Bar ── */
    .stats-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.6rem;
    }

    .stat-chip {
        background: #fff;
        border: 1px solid #e2eaf8;
        border-radius: 12px;
        padding: 0.7rem 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        box-shadow: 0 1px 4px rgba(15,42,110,0.05);
        flex: 1;
        min-width: 160px;
    }

    .stat-chip-icon {
        width: 38px;
        height: 38px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .stat-chip-icon.blue   { background: #eff6ff; color: var(--blue-600); }
    .stat-chip-icon.green  { background: #f0fdf4; color: #16a34a; }
    .stat-chip-icon.orange { background: #fff7ed; color: #ea580c; }
    .stat-chip-icon.indigo { background: #eef2ff; color: #4f46e5; }

    .stat-chip-value {
        font-size: 1.15rem;
        font-weight: 800;
        color: #0f1e4a;
        line-height: 1;
    }

    .stat-chip-label {
        font-size: 0.72rem;
        color: #64748b;
        font-weight: 500;
        margin-top: 2px;
    }

    /* ── Filter Card ── */
    .filter-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        overflow: hidden;
        margin-bottom: 1.6rem;
    }

    .filter-card-accent {
        height: 3px;
        background: linear-gradient(90deg, var(--blue-400), var(--blue-600), var(--blue-400));
    }

    .filter-card-body {
        padding: 1.3rem 1.5rem;
    }

    .filter-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .filter-header-left {
        display: flex;
        align-items: center;
        gap: 0.7rem;
    }

    .filter-header-icon {
        width: 36px;
        height: 36px;
        background: #eff6ff;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .filter-header-icon i {
        color: var(--blue-600);
        font-size: 0.95rem;
    }

    .filter-header-title {
        font-size: 0.92rem;
        font-weight: 700;
        color: #0f1e4a;
    }

    .filter-header-sub {
        font-size: 0.72rem;
        color: #94a3b8;
        font-weight: 500;
    }

    .btn-reset-filter {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.35rem 0.8rem;
        background: #fff5f5;
        color: #ef4444;
        border: 1px solid #fecaca;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.76rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-reset-filter:hover {
        background: #ef4444;
        color: #fff;
        border-color: #ef4444;
    }

    .filter-form-row {
        display: grid;
        grid-template-columns: 2fr 1.5fr auto;
        gap: 0.8rem;
        align-items: end;
    }

    .filter-group label {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #64748b;
        margin-bottom: 0.35rem;
    }

    .filter-group label i {
        color: var(--blue-500);
        font-size: 0.8rem;
    }

    .filter-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .filter-input-icon {
        position: absolute;
        left: 0;
        width: 38px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--blue-600), var(--blue-800));
        border-radius: 9px 0 0 9px;
        z-index: 2;
    }

    .filter-input-icon i {
        color: #fff;
        font-size: 0.8rem;
    }

    .filter-input {
        width: 100%;
        padding: 0.55rem 0.8rem 0.55rem 2.8rem;
        border: 1.5px solid #e2eaf8;
        border-radius: 9px;
        font-size: 0.85rem;
        font-weight: 500;
        color: #1e293b;
        background: #fff;
        outline: none;
        transition: all 0.25s ease;
        font-family: inherit;
    }

    .filter-input:focus {
        border-color: var(--blue-400);
        box-shadow: 0 0 0 3px rgba(96,165,250,0.15);
        background: #fafbff;
    }

    .filter-input::placeholder {
        color: #94a3b8;
        font-weight: 400;
    }

    .btn-filter-search {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        padding: 0.55rem 1.2rem;
        background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
        color: #fff;
        border: none;
        border-radius: 9px;
        font-size: 0.84rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
        box-shadow: 0 3px 10px rgba(29,78,216,0.3);
    }

    .btn-filter-search:hover {
        box-shadow: 0 5px 16px rgba(29,78,216,0.45);
        transform: translateY(-1px);
    }

    /* Active Filters */
    .active-filters {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-top: 0.8rem;
        padding-top: 0.8rem;
        border-top: 1px solid #f1f5fb;
    }

    .active-filters-label {
        font-size: 0.72rem;
        color: #94a3b8;
        font-weight: 600;
    }

    .filter-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.7rem;
        border-radius: 20px;
        font-size: 0.72rem;
        font-weight: 700;
    }

    .filter-badge.blue   { background: #eff6ff; color: var(--blue-700); border: 1px solid var(--blue-100); }
    .filter-badge.purple { background: #f5f3ff; color: #7c3aed; border: 1px solid #ddd6fe; }

    /* ── Table Container ── */
    .table-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        overflow: hidden;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table thead th {
        background: #fafbff;
        color: #64748b;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 1rem 1rem;
        border-bottom: 2px solid #e2eaf8;
        text-align: left;
        white-space: nowrap;
    }

    .custom-table tbody td {
        padding: 0.85rem 1rem;
        border-bottom: 1px solid #f1f5fb;
        color: #1e293b;
        font-size: 0.86rem;
        font-weight: 500;
        vertical-align: middle;
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    .custom-table tbody tr {
        transition: all 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background: #f8faff;
    }

    /* ── Ref Badge ── */
    .badge-ref {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: #eff6ff;
        color: var(--blue-700);
        padding: 0.25rem 0.6rem;
        border-radius: 7px;
        font-size: 0.8rem;
        font-weight: 700;
        border: 1px solid var(--blue-100);
    }

    /* ── Client Avatar ── */
    .client-cell {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .client-avatar {
        width: 34px;
        height: 34px;
        background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #fff;
        font-size: 0.78rem;
        font-weight: 800;
        box-shadow: 0 2px 6px rgba(29,78,216,0.25);
    }

    .client-name {
        font-weight: 700;
        color: #0f1e4a;
    }

    /* ── Statut Badges ── */
    .badge-statut {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.3rem 0.7rem;
        border-radius: 20px;
        font-size: 0.74rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .badge-statut .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
        flex-shrink: 0;
    }

    .badge-statut.nouvelle    { background: #eff6ff; color: var(--blue-600); border: 1px solid #bfdbfe; }
    .badge-statut.preparation { background: #fff7ed; color: #ea580c; border: 1px solid #fed7aa; }
    .badge-statut.expediee    { background: #f5f3ff; color: #7c3aed; border: 1px solid #ddd6fe; }
    .badge-statut.livree      { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .badge-statut.annulee     { background: #fef2f2; color: #ef4444; border: 1px solid #fecaca; }
    .badge-statut.default     { background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; }

    /* Paiement */
    .badge-paiement {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.3rem 0.7rem;
        border-radius: 20px;
        font-size: 0.74rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .badge-paiement .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
        flex-shrink: 0;
    }

    .badge-paiement.paye      { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .badge-paiement.partiel   { background: #fff7ed; color: #ea580c; border: 1px solid #fed7aa; }
    .badge-paiement.non-paye  { background: #fef2f2; color: #ef4444; border: 1px solid #fecaca; }
    .badge-paiement.default   { background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; }

    /* ── Montant ── */
    .montant-cell {
        font-weight: 800;
        color: #0f1e4a;
        white-space: nowrap;
    }

    .montant-cell .currency {
        font-size: 0.7rem;
        font-weight: 500;
        color: #64748b;
        margin-left: 2px;
    }

    /* ── Action Buttons ── */
    .action-buttons {
        display: flex;
        gap: 0.4rem;
        justify-content: center;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        font-size: 0.85rem;
    }

    .btn-icon-view   { background: #f0fdf4; color: #16a34a; border: 1.5px solid #bbf7d0; }
    .btn-icon-view:hover   { background: #16a34a; color: #fff; border-color: #16a34a; }

    .btn-icon-edit   { background: #eff6ff; color: var(--blue-600); border: 1.5px solid #bfdbfe; }
    .btn-icon-edit:hover   { background: var(--blue-600); color: #fff; border-color: var(--blue-600); }

    .btn-icon-delete { background: #fff5f5; color: #ef4444; border: 1.5px solid #fecaca; }
    .btn-icon-delete:hover { background: #ef4444; color: #fff; border-color: #ef4444; }

    /* ── Alert ── */
    .alert-success {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #15803d;
        border-radius: 12px;
        padding: 0.85rem 1.2rem;
        margin-bottom: 1.5rem;
        font-size: 0.88rem;
        font-weight: 600;
    }

    /* ── Empty State ── */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        background: #eff6ff;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
    }

    .empty-state-icon i {
        font-size: 2.2rem;
        color: var(--blue-400);
    }

    .empty-state h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #475569;
        margin-bottom: 0.4rem;
    }

    .empty-state p {
        font-size: 0.85rem;
        color: #94a3b8;
        margin-bottom: 1.2rem;
    }

    /* ── Pagination ── */
    .pagination-wrapper {
        padding: 1rem 1.2rem;
        background: #fafbff;
        border-top: 1px solid #e2eaf8;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
        .filter-form-row {
            grid-template-columns: 1fr 1fr;
        }

        .filter-form-row .btn-filter-search {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .page-header-right {
            width: 100%;
        }

        .filter-form-row {
            grid-template-columns: 1fr;
        }

        .stats-bar {
            gap: 0.7rem;
        }

        .stat-chip {
            min-width: calc(50% - 0.35rem);
        }

        .custom-table thead th,
        .custom-table tbody td {
            padding: 0.7rem 0.6rem;
            font-size: 0.78rem;
        }

        .client-cell {
            min-width: 140px;
        }
    }

    @media (max-width: 480px) {
        .stat-chip {
            min-width: 100%;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-bag-plus-fill me-2" style="color:var(--blue-500);"></i>Commandes</h2>
        <p>Gérez vos commandes clients, statuts et paiements</p>
    </div>
    <div style="display: flex; gap: 0.8rem; align-items: center;">
        @if($showValidated)
            <a href="{{ route('commandes.index', array_merge(request()->all(), ['show_validated' => 0])) }}" class="btn-back" style="padding: 0.55rem 1rem; border-radius: 10px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.84rem; font-weight: 700; background: #f8fafc; border: 1.5px solid #e2eaf8; color: #64748b;">
                <i class="bi bi-eye-slash-fill"></i> Masquer livrées
            </a>
        @else
            <a href="{{ route('commandes.index', array_merge(request()->all(), ['show_validated' => 1])) }}" class="btn-back" style="padding: 0.55rem 1rem; border-radius: 10px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.84rem; font-weight: 700; background: #eff6ff; border: 1.5px solid #bfdbfe; color: var(--blue-600);">
                <i class="bi bi-eye-fill"></i> Afficher livrées
            </a>
        @endif
        <a href="{{ route('commandes.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Nouvelle Commande
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert-success">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
@endif

<!-- Stats -->
<div class="stats-bar">
    <div class="stat-chip">
        <div class="stat-chip-icon blue"><i class="bi bi-bag-fill"></i></div>
        <div>
            <div class="stat-chip-value">{{ $stats['total'] }}</div>
            <div class="stat-chip-label">Total Commandes</div>
        </div>
    </div>
    <div class="stat-chip">
        <div class="stat-chip-icon green"><i class="bi bi-check-circle-fill"></i></div>
        <div>
            <div class="stat-chip-value">{{ $stats['livrees'] }}</div>
            <div class="stat-chip-label">Livrées</div>
        </div>
    </div>
    <div class="stat-chip">
        <div class="stat-chip-icon orange"><i class="bi bi-clock-history"></i></div>
        <div>
            <div class="stat-chip-value">{{ $stats['en_cours'] }}</div>
            <div class="stat-chip-label">En cours</div>
        </div>
    </div>
    <div class="stat-chip">
        <div class="stat-chip-icon indigo"><i class="bi bi-cash-stack"></i></div>
        <div>
            <div class="stat-chip-value">{{ number_format($stats['montant_total'], 2, ',', ' ') }} <span style="font-size:0.72rem;font-weight:500;color:#64748b;">DH</span></div>
            <div class="stat-chip-label">Montant Total</div>
        </div>
    </div>
</div>

<!-- Filter Card -->
<div class="filter-card">
    <div class="filter-card-accent"></div>
    <div class="filter-card-body">
        <div class="filter-header">
            <div class="filter-header-left">
                <div class="filter-header-icon">
                    <i class="bi bi-funnel-fill"></i>
                </div>
                <div>
                    <div class="filter-header-title">Filtrer les commandes</div>
                    <div class="filter-header-sub">Recherchez par numéro ou par date</div>
                </div>
            </div>
            @if(request()->hasAny(['numero_commande', 'date_commande']))
                <a href="{{ route('commandes.index') }}" class="btn-reset-filter">
                    <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
                </a>
            @endif
        </div>

        <form action="{{ route('commandes.index') }}" method="GET">
            <div class="filter-form-row">
                <!-- N° Commande -->
                <div class="filter-group">
                    <label for="numero_commande">
                        <i class="bi bi-hash"></i> N° Commande
                    </label>
                    <div class="filter-input-wrapper">
                        <div class="filter-input-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <input type="text" class="filter-input" name="numero_commande" id="numero_commande"
                               value="{{ request('numero_commande') }}"
                               placeholder="Ex: CMD-2024-001...">
                    </div>
                </div>

                <!-- Date -->
                <div class="filter-group">
                    <label for="date_commande">
                        <i class="bi bi-calendar3"></i> Date de Commande
                    </label>
                    <div class="filter-input-wrapper">
                        <div class="filter-input-icon">
                            <i class="bi bi-calendar3"></i>
                        </div>
                        <input type="date" class="filter-input" name="date_commande" id="date_commande"
                               value="{{ request('date_commande') }}">
                    </div>
                </div>

                <!-- Search Button -->
                <div class="filter-group" style="display:flex;align-items:flex-end;">
                    <button type="submit" class="btn-filter-search">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                </div>
            </div>

            @if(request()->hasAny(['numero_commande', 'date_commande']))
                <div class="active-filters">
                    <span class="active-filters-label">Filtres actifs :</span>
                    @if(request('numero_commande'))
                        <span class="filter-badge blue">
                            <i class="bi bi-hash" style="font-size:0.65rem;"></i> N°: {{ request('numero_commande') }}
                        </span>
                    @endif
                    @if(request('date_commande'))
                        <span class="filter-badge purple">
                            <i class="bi bi-calendar3" style="font-size:0.65rem;"></i> Date: {{ request('date_commande') }}
                        </span>
                    @endif
                </div>
            @endif
        </form>
    </div>
</div>

<!-- Table Card -->
<div class="table-card">
    <div style="overflow-x: auto;">
        <table class="custom-table">
            <thead>
                <tr>
                    <th><i class="bi bi-hash me-1"></i> Réf.</th>
                    <th><i class="bi bi-calendar3 me-1"></i> Date</th>
                    <th><i class="bi bi-person me-1"></i> Client</th>
                    <th><i class="bi bi-truck me-1"></i> Livraison</th>
                    <th><i class="bi bi-truck-flatbed me-1"></i> Expédition</th>
                    <th style="text-align:center;"><i class="bi bi-flag me-1"></i> Statut</th>
                    <th style="text-align:center;"><i class="bi bi-wallet2 me-1"></i> Paiement</th>
                    <th style="text-align:right;"><i class="bi bi-cash me-1"></i> Montant</th>
                    <th style="width:130px;text-align:center;"><i class="bi bi-gear me-1"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($commandeClient as $commande)
                    <tr>
                        <!-- Réf -->
                        <td>
                            <span class="badge-ref">
                                <i class="bi bi-bag" style="font-size:0.7rem;"></i>
                                {{ $commande->numero_commande ?: '#' . $commande->id }}
                            </span>
                        </td>

                        <!-- Date -->
                        <td>
                            <span style="font-weight:600;color:#1e293b;">
                                {{ $commande->date_commande ? \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') : '—' }}
                            </span>
                        </td>

                        <!-- Client -->
                        <td>
                            <div class="client-cell">
                                <div class="client-avatar">
                                    {{ strtoupper(substr($commande->client->nom_entreprise ?? 'C', 0, 1)) }}
                                </div>
                                <span class="client-name">{{ $commande->client->nom_entreprise ?? 'Client Inconnu' }}</span>
                            </div>
                        </td>

                        <!-- Livraison -->
                        <td>
                            <span style="font-weight:600;color:#64748b;">
                                {{ $commande->date_livraison ? \Carbon\Carbon::parse($commande->date_livraison)->format('d/m/Y') : '—' }}
                            </span>
                        </td>

                        <!-- Expédition -->
                        <td>
                            <span style="font-weight:600;color:#1e293b; font-size: 0.8rem;">
                                @if($commande->expedition)
                                    {{ $commande->expedition->employes->nom_complet ?? 'N/A' }} <br>
                                    <span style="color:#64748b; font-size: 0.75rem;">{{ \Carbon\Carbon::parse($commande->expedition->date_expedition)->format('d/m/Y') }}</span>
                                @else
                                    —
                                @endif
                            </span>
                        </td>

                        <!-- Statut -->
                        <td style="text-align:center;">
                            @php
                                $statutClass = match($commande->statut) {
                                    'Nouvelle' => 'nouvelle',
                                    'En préparation' => 'preparation',
                                    'Expédiée' => 'expediee',
                                    'Livrée' => 'livree',
                                    'Annulée' => 'annulee',
                                    default => 'default'
                                };
                            @endphp
                            <span class="badge-statut {{ $statutClass }}">
                                <span class="dot"></span>
                                {{ $commande->statut ?: 'Non défini' }}
                            </span>
                        </td>

                        <!-- Paiement -->
                        <td style="text-align:center;">
                            @php
                                $paiementClass = match($commande->statut_paiement) {
                                    'Payé' => 'paye',
                                    'Partiellement payé' => 'partiel',
                                    'Non payé' => 'non-paye',
                                    default => 'default'
                                };
                            @endphp
                            <span class="badge-paiement {{ $paiementClass }}">
                                <span class="dot"></span>
                                {{ $commande->statut_paiement ?: 'Non défini' }}
                            </span>
                        </td>

                        <!-- Montant -->
                        <td style="text-align:right;">
                            <span class="montant-cell">
                                {{ number_format($commande->montant_total, 2, ',', ' ') }}
                                <span class="currency">DH</span>
                            </span>
                        </td>

                        <!-- Actions -->
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('commandes.show', $commande->id) }}" class="btn-icon btn-icon-view" title="Détails">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                @if($commande->statut !== 'Livrée' && $commande->statut !== 'Livré')
                                    <a href="{{ route('commandes.edit', $commande->id) }}" class="btn-icon btn-icon-edit" title="Modifier">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');" style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon btn-icon-delete" title="Supprimer">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="bi bi-bag-x"></i>
                                </div>
                                <h4>Aucune commande trouvée</h4>
                                <p>Commencez par créer votre première commande client.</p>
                                <a href="{{ route('commandes.create') }}" class="btn-add">
                                    <i class="bi bi-plus-lg"></i> Créer une Commande
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(count($commandeClient) > 0)
    <div class="pagination-wrapper">
        <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">
            Total : {{ count($commandeClient) }} commande(s)
        </span>
    </div>
    @endif
</div>

@endsection