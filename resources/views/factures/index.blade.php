@extends('_layout')
@section('title', 'Factures')
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
        min-width: 180px;
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
    .stat-chip-icon.red    { background: #fef2f2; color: #ef4444; }

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

    /* ── Search Bar ── */
    .search-bar {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .search-input {
        padding: 0.55rem 1rem;
        border: 1.5px solid #e2eaf8;
        border-radius: 10px;
        font-size: 0.88rem;
        outline: none;
        width: 250px;
        background: #fff;
        color: #1e293b;
        font-family: inherit;
        transition: all 0.2s ease;
    }

    .search-input:focus {
        border-color: var(--blue-400);
        box-shadow: 0 0 0 4px rgba(96,165,250,0.15);
    }

    .search-input::placeholder {
        color: #94a3b8;
    }

    .btn-search {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.55rem 0.8rem;
        background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
        color: #fff;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.88rem;
    }

    .btn-search:hover {
        box-shadow: 0 4px 14px rgba(29,78,216,0.35);
        transform: translateY(-1px);
    }

    .btn-clear {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.55rem 0.8rem;
        background: #fff5f5;
        color: #ef4444;
        border: 1px solid #fecaca;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 0.88rem;
    }

    .btn-clear:hover {
        background: #ef4444;
        color: #fff;
        border-color: #ef4444;
    }

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

    /* ── Badges ── */
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

    .badge-montant {
        font-weight: 800;
        color: #0f1e4a;
    }

    .badge-montant .currency {
        font-size: 0.7rem;
        font-weight: 500;
        color: #64748b;
        margin-left: 2px;
    }

    .badge-statut {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.3rem 0.7rem;
        border-radius: 20px;
        font-size: 0.76rem;
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

    .badge-statut.payee       { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .badge-statut.partielle   { background: #fff7ed; color: #ea580c; border: 1px solid #fed7aa; }
    .badge-statut.non-payee   { background: #fef2f2; color: #ef4444; border: 1px solid #fecaca; }
    .badge-statut.annulee     { background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; }
    .badge-statut.default     { background: #eff6ff; color: var(--blue-600); border: 1px solid #bfdbfe; }

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

    .btn-icon-print  { background: #f5f3ff; color: #7c3aed; border: 1.5px solid #ddd6fe; }
    .btn-icon-print:hover  { background: #7c3aed; color: #fff; border-color: #7c3aed; }

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

    /* ── Progress Bar (for payment) ── */
    .payment-progress {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .progress-bar-bg {
        width: 60px;
        height: 6px;
        background: #e2eaf8;
        border-radius: 3px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .progress-bar-fill {
        height: 100%;
        border-radius: 3px;
        transition: width 0.3s ease;
    }

    .progress-bar-fill.green  { background: #16a34a; }
    .progress-bar-fill.orange { background: #ea580c; }
    .progress-bar-fill.red    { background: #ef4444; }

    .progress-text {
        font-size: 0.72rem;
        font-weight: 700;
        color: #64748b;
        white-space: nowrap;
    }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
        .search-input {
            width: 180px;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .page-header-right {
            width: 100%;
            flex-direction: column;
            gap: 0.7rem;
        }

        .search-bar {
            width: 100%;
        }

        .search-input {
            flex: 1;
            width: auto;
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
        <h2><i class="bi bi-receipt-cutoff me-2" style="color:var(--blue-500);"></i>Factures</h2>
        <p>Gestion et suivi de toutes vos factures clients</p>
    </div>

    <div class="page-header-right" style="display: flex; gap: 0.8rem; align-items: center;">
        <form action="{{ route('factures.index') }}" method="GET" class="search-bar" style="margin:0;">
            <input type="text" name="search" class="search-input" placeholder="Rechercher une facture..."
                   value="{{ request('search') }}">
            <button type="submit" class="btn-search">
                <i class="bi bi-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('factures.index') }}" class="btn-clear">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </form>
        <a href="{{ route('factures.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Nouvelle Facture
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert-success">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
@endif

<!-- Stats -->
<div class="stats-bar">
    <div class="stat-chip">
        <div class="stat-chip-icon blue"><i class="bi bi-receipt"></i></div>
        <div>
            <div class="stat-chip-value">{{ count($factures) }}</div>
            <div class="stat-chip-label">Total Factures</div>
        </div>
    </div>
    <div class="stat-chip">
        <div class="stat-chip-icon green"><i class="bi bi-check-circle"></i></div>
        <div>
            @php
                $payees = $factures->where('statut', 'Payée')->count();
            @endphp
            <div class="stat-chip-value">{{ $payees }}</div>
            <div class="stat-chip-label">Payées</div>
        </div>
    </div>
    <div class="stat-chip">
        <div class="stat-chip-icon orange"><i class="bi bi-clock-history"></i></div>
        <div>
            @php
                $enAttente = $factures->whereIn('statut', ['Non payée', 'Partiellement payée'])->count();
            @endphp
            <div class="stat-chip-value">{{ $enAttente }}</div>
            <div class="stat-chip-label">En attente</div>
        </div>
    </div>
    <div class="stat-chip">
        <div class="stat-chip-icon blue"><i class="bi bi-cash-stack"></i></div>
        <div>
            <div class="stat-chip-value">{{ number_format($factures->sum('montant_total'), 2, ',', ' ') }} <span style="font-size:0.72rem;font-weight:500;color:#64748b;">DH</span></div>
            <div class="stat-chip-label">Montant Total</div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="table-card">
    <div style="overflow-x: auto;">
        <table class="custom-table">
            <thead>
                <tr>
                    <th><i class="bi bi-hash me-1"></i> N° Facture</th>
                    <th><i class="bi bi-bag me-1"></i> Commande</th>
                    <th><i class="bi bi-calendar3 me-1"></i> Date Facture</th>
                    <th><i class="bi bi-calendar-check me-1"></i> Échéance</th>
                    <th><i class="bi bi-calculator me-1"></i> Sous Total</th>
                    <th><i class="bi bi-percent me-1"></i> TVA</th>
                    <th><i class="bi bi-cash me-1"></i> Total</th>
                    <th><i class="bi bi-wallet2 me-1"></i> Payé</th>
                    <th style="text-align:center;"><i class="bi bi-flag me-1"></i> Statut</th>
                    <th style="width: 130px; text-align: center;"><i class="bi bi-gear me-1"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($factures as $facture)
                    <tr>
                        <!-- N° Facture -->
                        <td>
                            <span class="badge-ref">
                                <i class="bi bi-receipt" style="font-size:0.7rem;"></i>
                                {{ $facture->numero_facture }}
                            </span>
                        </td>

                        <!-- Commande -->
                        <td>
                            <div style="display:flex;align-items:center;gap:0.5rem;">
                                <div style="width:30px;height:30px;background:#eff6ff;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="bi bi-bag-fill" style="color:var(--blue-600);font-size:0.8rem;"></i>
                                </div>
                                <span style="font-weight:600;">{{ $facture->commande_client->numero_commande ?? '—' }}</span>
                            </div>
                        </td>

                        <!-- Date Facture -->
                        <td>
                            <span style="font-weight:600;color:#1e293b;">
                                {{ $facture->date_facture ? \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') : '—' }}
                            </span>
                        </td>

                        <!-- Date Échéance -->
                        <td>
                            @if($facture->date_echeance)
                                @php
                                    $echeance = \Carbon\Carbon::parse($facture->date_echeance);
                                    $isOverdue = $echeance->isPast() && $facture->statut !== 'Payée';
                                @endphp
                                <span style="font-weight:600;color:{{ $isOverdue ? '#ef4444' : '#1e293b' }};">
                                    {{ $echeance->format('d/m/Y') }}
                                    @if($isOverdue)
                                        <i class="bi bi-exclamation-triangle-fill" style="font-size:0.7rem;margin-left:3px;"></i>
                                    @endif
                                </span>
                            @else
                                <span style="color:#94a3b8;">—</span>
                            @endif
                        </td>

                        <!-- Sous Total -->
                        <td>
                            <span class="badge-montant">
                                {{ number_format($facture->sous_total, 2, ',', ' ') }}
                                <span class="currency">DH</span>
                            </span>
                        </td>

                        <!-- TVA -->
                        <td>
                            <span style="font-weight:600;color:#64748b;">
                                {{ number_format($facture->montant_tva, 2, ',', ' ') }}
                                <span style="font-size:0.7rem;font-weight:400;">DH</span>
                            </span>
                        </td>

                        <!-- Total -->
                        <td>
                            <span class="badge-montant" style="color:var(--blue-700);">
                                {{ number_format($facture->montant_total, 2, ',', ' ') }}
                                <span class="currency">DH</span>
                            </span>
                        </td>

                        <!-- Montant Payé + Progress -->
                        <td>
                            @php
                                $paye = $facture->montant_paye ?? 0;
                                $total = $facture->montant_total ?? 1;
                                $percent = $total > 0 ? min(100, round(($paye / $total) * 100)) : 0;
                                $barColor = $percent >= 100 ? 'green' : ($percent > 0 ? 'orange' : 'red');
                            @endphp
                            <div class="payment-progress">
                                <div class="progress-bar-bg">
                                    <div class="progress-bar-fill {{ $barColor }}" style="width:{{ $percent }}%;"></div>
                                </div>
                                <span class="progress-text">{{ number_format($paye, 2, ',', ' ') }} DH</span>
                            </div>
                        </td>

                        <!-- Statut -->
                        <td style="text-align:center;">
                            @php
                                $statutClass = match($facture->statut) {
                                    'Payée' => 'payee',
                                    'Partiellement payée' => 'partielle',
                                    'Non payée' => 'non-payee',
                                    'Annulée' => 'annulee',
                                    default => 'default'
                                };
                            @endphp
                            <span class="badge-statut {{ $statutClass }}">
                                <span class="dot"></span>
                                {{ $facture->statut ?? 'Non défini' }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('factures.show', $facture->id) }}" class="btn-icon btn-icon-view" title="Détails">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('factures.edit', $facture->id) }}" class="btn-icon btn-icon-edit" title="Modifier">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('factures.destroy', $facture->id) }}" method="POST"
                                      onsubmit="return confirm('Voulez-vous vraiment supprimer cette facture ?');" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-icon-delete" title="Supprimer">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="bi bi-receipt"></i>
                                </div>
                                <h4>Aucune facture trouvée</h4>
                                <p>Commencez par créer votre première facture client.</p>
                                <a href="{{ route('factures.create') }}" class="btn-add">
                                    <i class="bi bi-plus-lg"></i> Créer une Facture
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(count($factures) > 0)
    <div class="pagination-wrapper">
        <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">
            Total : {{ count($factures) }} facture(s)
        </span>
    </div>
    @endif
</div>

@endsection