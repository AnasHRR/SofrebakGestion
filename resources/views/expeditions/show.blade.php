@extends('_layout')
@section('title', 'Détails de l\'expédition')
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

    .header-actions {
        display: flex;
        gap: 0.6rem;
        flex-wrap: wrap;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: #fff;
        color: #64748b;
        font-size: 0.84rem;
        font-weight: 700;
        padding: 0.55rem 1.1rem;
        border-radius: 10px;
        text-decoration: none;
        border: 1.5px solid #e2eaf8;
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background: var(--blue-50);
        border-color: var(--blue-100);
        color: var(--blue-600);
        transform: translateY(-1px);
    }

    .btn-edit-main {
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
    }

    .btn-edit-main:hover {
        box-shadow: 0 6px 20px rgba(29,78,216,0.5);
        transform: translateY(-1px);
        color: #fff;
    }

    /* ── Detail Layout ── */
    .detail-layout {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 1.4rem;
    }

    /* ── Detail Card ── */
    .detail-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        overflow: hidden;
    }

    .detail-card:hover {
        box-shadow: 0 8px 28px rgba(29,78,216,0.1);
    }

    .detail-card-header {
        background: linear-gradient(135deg, var(--blue-700), var(--blue-900));
        padding: 1.5rem 1.8rem;
        display: flex;
        align-items: center;
        gap: 1.1rem;
        position: relative;
        overflow: hidden;
    }

    .detail-card-header::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 160px; height: 160px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }

    .detail-avatar {
        width: 56px; height: 56px;
        background: rgba(255,255,255,0.15);
        border-radius: 15px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        border: 2px solid rgba(255,255,255,0.2);
        position: relative; z-index: 1;
    }

    .detail-avatar i { color: #fff; font-size: 1.5rem; }

    .detail-header-info { flex: 1; position: relative; z-index: 1; }

    .detail-name {
        font-size: 1.2rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 6px;
    }

    .detail-badges { display: flex; gap: 0.5rem; flex-wrap: wrap; }

    .detail-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: rgba(255,255,255,0.15);
        border-radius: 7px;
        padding: 3px 10px;
        font-size: 0.7rem;
        color: rgba(255,255,255,0.85);
        font-weight: 600;
        backdrop-filter: blur(4px);
    }

    .detail-badge i { font-size: 0.65rem; }

    /* Card Body */
    .detail-card-body { padding: 1.5rem 1.8rem; }

    .section-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--blue-600);
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #eff6ff;
    }

    .section-title i { font-size: 0.85rem; }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
    }

    .info-field {
        display: flex;
        align-items: flex-start;
        gap: 0.8rem;
        padding: 0.8rem 0.8rem;
        border-bottom: 1px solid #f1f5fb;
        border-radius: 10px;
        margin: 0 -0.5rem;
        transition: background 0.2s;
    }

    .info-field:hover { background: #f8faff; }
    .info-field.full-width { grid-column: 1 / -1; }

    .info-field-icon {
        width: 36px; height: 36px;
        background: #eff6ff;
        border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        transition: all 0.2s;
    }

    .info-field:hover .info-field-icon { background: var(--blue-500); }
    .info-field-icon i { color: var(--blue-600); font-size: 0.9rem; transition: color 0.2s; }
    .info-field:hover .info-field-icon i { color: #fff; }

    .info-field-label {
        font-size: 0.66rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #94a3b8;
        margin-bottom: 3px;
    }

    .info-field-value {
        font-size: 0.9rem;
        font-weight: 600;
        color: #1e293b;
    }

    /* ── Products Table ── */
    .products-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        overflow: hidden;
        margin-top: 1.4rem;
    }

    .products-header {
        padding: 1.2rem 1.8rem;
        border-bottom: 1px solid #e2eaf8;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .products-header h3 {
        font-size: 0.95rem;
        font-weight: 800;
        color: #0f1e4a;
        margin: 0;
    }

    .products-header .count-badge {
        background: var(--blue-500);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 20px;
    }

    .products-table {
        width: 100%;
        border-collapse: collapse;
    }

    .products-table thead th {
        background: #fafbff;
        color: #64748b;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 0.85rem 1rem;
        border-bottom: 2px solid #e2eaf8;
        text-align: left;
    }

    .products-table tbody td {
        padding: 0.8rem 1rem;
        border-bottom: 1px solid #f1f5fb;
        font-size: 0.86rem;
        font-weight: 500;
        color: #1e293b;
        vertical-align: middle;
    }

    .products-table tbody tr:hover { background: #f8faff; }
    .products-table tbody tr:last-child td { border-bottom: none; }

    /* ── Sidebar ── */
    .sidebar-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .sidebar-card-body { padding: 1.4rem; }

    /* Badges */
    .badge-statut {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.4rem 0.8rem;
        border-radius: 10px;
        font-size: 0.78rem;
        font-weight: 700;
        width: 100%;
        justify-content: center;
    }

    .badge-statut .dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        background: currentColor;
    }

    .badge-statut.nouvelle    { background: #eff6ff; color: var(--blue-600); border: 1px solid #bfdbfe; }
    .badge-statut.preparation { background: #fff7ed; color: #ea580c; border: 1px solid #fed7aa; }
    .badge-statut.expediee    { background: #f5f3ff; color: #7c3aed; border: 1px solid #ddd6fe; }
    .badge-statut.livree      { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .badge-statut.annulee     { background: #fef2f2; color: #ef4444; border: 1px solid #fecaca; }
    .badge-statut.default     { background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; }

    .status-row {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    /* Sidebar Summary */
    .summary-box {
        background: #f8faff;
        border: 1px solid #e2eaf8;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 0.35rem 0;
        font-size: 0.84rem;
    }

    .summary-row .label { color: #64748b; font-weight: 500; }
    .summary-row .value { font-weight: 700; color: #1e293b; }

    /* Sidebar actions */
    .sidebar-actions {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .sidebar-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.6rem 1rem;
        border-radius: 10px;
        font-size: 0.84rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    .sidebar-btn-edit { background: #eff6ff; color: var(--blue-600); border: 1.5px solid #bfdbfe; }
    .sidebar-btn-edit:hover { background: var(--blue-600); color: #fff; border-color: var(--blue-600); transform: translateY(-1px); }

    .sidebar-btn-delete { background: #fff5f5; color: #ef4444; border: 1.5px solid #fecaca; }
    .sidebar-btn-delete:hover { background: #ef4444; color: #fff; border-color: #ef4444; transform: translateY(-1px); }

    .sidebar-btn-back { background: #f8fafc; color: #64748b; border: 1.5px solid #e2eaf8; }
    .sidebar-btn-back:hover { background: #e2eaf8; color: #475569; transform: translateY(-1px); }

    /* ── Responsive ── */
    @media (max-width: 900px) {
        .detail-layout { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: flex-start; }
        .info-grid { grid-template-columns: 1fr; }
        .detail-card-body { padding: 1rem 1.3rem; }
        .header-actions { width: 100%; }
        .header-actions a, .header-actions button { flex: 1; justify-content: center; }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-truck-flatbed me-2" style="color:var(--blue-500);"></i>Détails de l'Expédition</h2>
        <p>Expédition du <strong>{{ \Carbon\Carbon::parse($expedition->date_expedition)->format('d/m/Y') }}</strong></p>
    </div>
    <div class="header-actions">
        <a href="{{ route('expeditions.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
        <a href="{{ route('expeditions.edit', $expedition->id) }}" class="btn-edit-main">
            <i class="bi bi-pencil-fill"></i> Modifier
        </a>
    </div>
</div>

<div class="detail-layout">

    <!-- Main Card -->
    <div>
        <div class="detail-card">
            <!-- Header -->
            <div class="detail-card-header">
                <div class="detail-avatar">
                    <i class="bi bi-truck"></i>
                </div>
                <div class="detail-header-info">
                    <div class="detail-name">Camion n° {{ $expedition->numero_camion }}</div>
                    <div class="detail-badges">
                        <span class="detail-badge">
                            <i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($expedition->date_expedition)->format('d/m/Y') }}
                        </span>
                        <span class="detail-badge">
                            <i class="bi bi-person"></i> {{ $expedition->employes->nom_complet ?? 'Non assigné' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="detail-card-body">
                <div class="section-title"><i class="bi bi-info-circle-fill"></i> Informations de l'expédition</div>
                <div class="info-grid">
                    <div class="info-field">
                        <div class="info-field-icon"><i class="bi bi-person-vcard"></i></div>
                        <div>
                            <div class="info-field-label">Chauffeur</div>
                            <div class="info-field-value">{{ $expedition->employes->nom_complet ?? '—' }}</div>
                        </div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-icon"><i class="bi bi-truck-front"></i></div>
                        <div>
                            <div class="info-field-label">N° de Camion</div>
                            <div class="info-field-value">{{ $expedition->numero_camion ?? '—' }}</div>
                        </div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-icon"><i class="bi bi-calendar-event"></i></div>
                        <div>
                            <div class="info-field-label">Date d'expédition</div>
                            <div class="info-field-value">{{ \Carbon\Carbon::parse($expedition->date_expedition)->format('d/m/Y') }}</div>
                        </div>
                    </div>
                    @if($expedition->notes_livraison)
                        <div class="info-field full-width">
                            <div class="info-field-icon"><i class="bi bi-sticky"></i></div>
                            <div>
                                <div class="info-field-label">Notes de livraison</div>
                                <div class="info-field-value" style="font-weight:500;color:#475569;">{{ $expedition->notes_livraison }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Commandes Clients Table -->
        <div class="products-card">
            <div class="products-header">
                <i class="bi bi-bag-check-fill" style="color:var(--blue-500);font-size:1.1rem;"></i>
                <h3>Commandes associées</h3>
                <span class="count-badge">{{ count($expedition->commandesClients) }}</span>
            </div>
            <div style="overflow-x:auto;">
                <table class="products-table">
                    <thead>
                        <tr>
                            <th><i class="bi bi-hash me-1"></i> Réf.</th>
                            <th><i class="bi bi-person me-1"></i> Client</th>
                            <th style="text-align:center;"><i class="bi bi-flag me-1"></i> Statut</th>
                            <th style="text-align:right;"><i class="bi bi-cash me-1"></i> Montant</th>
                            <th style="text-align:center;"><i class="bi bi-gear me-1"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($expedition->commandesClients as $commande)
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:0.5rem;">
                                        <div style="width:30px;height:30px;background:#eff6ff;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                            <i class="bi bi-bag-fill" style="color:var(--blue-600);font-size:0.8rem;"></i>
                                        </div>
                                        <span style="font-weight:700;color:#0f1e4a;">{{ $commande->numero_commande ?: '#' . $commande->id }}</span>
                                    </div>
                                </td>
                                <td><span style="font-weight:600;color:#64748b;">{{ $commande->client->nom_entreprise ?? 'Client Inconnu' }}</span></td>
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
                                    <span class="badge-statut {{ $statutClass }}" style="width:auto;">
                                        <span class="dot"></span>
                                        {{ $commande->statut ?: 'Non défini' }}
                                    </span>
                                </td>
                                <td style="text-align:right;font-weight:800;color:#0f1e4a;">
                                    {{ number_format($commande->montant_total, 2, ',', ' ') }} <span style="font-size:0.7rem;color:#64748b;font-weight:500;">DH</span>
                                </td>
                                <td style="text-align:center;">
                                    <a href="{{ route('commandes.show', $commande->id) }}" class="sidebar-btn-edit" style="width:auto; padding: 0.35rem 0.6rem; display:inline-flex; align-items:center; border-radius:6px; text-decoration:none;" title="Détails de la commande">
                                        <i class="bi bi-eye-fill"></i> Détails
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center;padding:3rem;color:#94a3b8;">
                                    <i class="bi bi-bag-x" style="font-size:1.5rem;display:block;margin-bottom:0.5rem;color:var(--blue-300);"></i>
                                    Aucune commande assignée à cette expédition.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div>
        <div class="sidebar-card">
            <div class="sidebar-card-body">
                <div class="section-title"><i class="bi bi-flag-fill"></i> Statut Liv.</div>

                <div class="status-row">
                    @php
                        $sClass = match($expedition->statut_livraison) {
                            'En attente' => 'preparation',
                            'En cours' => 'expediee',
                            'Livré' => 'livree',
                            'Annulée' => 'annulee',
                            default => 'default'
                        };
                    @endphp
                    <span class="badge-statut {{ $sClass }}">
                        <span class="dot"></span> {{ $expedition->statut_livraison ?? 'Non défini' }}
                    </span>
                </div>
                
                @if($expedition->statut_livraison !== 'Livré')
                    <form action="{{ route('expeditions.valider', $expedition->id) }}" method="POST"
                          onsubmit="return confirm('Valider cette expédition changera son statut en Livré ainsi que toutes ses commandes. Confirmer ?');"
                          style="margin-top: 1rem; margin-bottom: 1rem;">
                        @csrf
                        <button type="submit" class="sidebar-btn" style="background: #f0fdf4; color: #16a34a; border: 1.5px solid #bbf7d0; font-weight:700;">
                            <i class="bi bi-check2-circle" style="font-size:1.1rem;"></i> Valider la livraison
                        </button>
                    </form>
                @endif

                <div class="summary-box" style="margin-top:1rem;">
                    <div class="summary-row">
                        <span class="label">Total Commandes</span>
                        <span class="value">{{ count($expedition->commandesClients) }}</span>
                    </div>
                </div>

                <div class="sidebar-actions">
                    <a href="{{ route('expeditions.edit', $expedition->id) }}" class="sidebar-btn sidebar-btn-edit">
                        <i class="bi bi-pencil-fill"></i> Modifier
                    </a>
                    <form action="{{ route('expeditions.destroy', $expedition->id) }}" method="POST"
                          onsubmit="return confirm('Supprimer cette expédition ?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="sidebar-btn sidebar-btn-delete">
                            <i class="bi bi-trash-fill"></i> Supprimer
                        </button>
                    </form>
                    <a href="{{ route('expeditions.index') }}" class="sidebar-btn sidebar-btn-back">
                        <i class="bi bi-arrow-return-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
