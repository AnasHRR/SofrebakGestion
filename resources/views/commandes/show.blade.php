@extends('_layout')
@section('title', 'Détails de commande')
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

    .btn-print {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: #f5f3ff;
        color: #7c3aed;
        font-size: 0.84rem;
        font-weight: 700;
        padding: 0.55rem 1.1rem;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-print:hover {
        background: #7c3aed;
        color: #fff;
        transform: translateY(-1px);
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

    .products-table tfoot td {
        padding: 1rem;
        border-top: 2px solid #e2eaf8;
        background: #fafbff;
    }

    .total-label {
        font-size: 0.85rem;
        font-weight: 800;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .total-value {
        font-size: 1.1rem;
        font-weight: 900;
        color: var(--blue-700);
    }

    .total-value .currency {
        font-size: 0.75rem;
        font-weight: 500;
        color: #64748b;
        margin-left: 2px;
    }

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
    .badge-statut.paye        { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .badge-statut.partiel     { background: #fff7ed; color: #ea580c; border: 1px solid #fed7aa; }
    .badge-statut.non-paye    { background: #fef2f2; color: #ef4444; border: 1px solid #fecaca; }
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
    .summary-row.total { border-top: 2px solid #e2eaf8; padding-top: 0.6rem; margin-top: 0.3rem; }
    .summary-row.total .label { font-weight: 700; color: #0f1e4a; }
    .summary-row.total .value { color: var(--blue-700); font-size: 1rem; }

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

    /* ── PRINT ── */
    .print-order { display: none; }

    @media print {
        .sidebar, .top-bar, .page-header, .detail-layout, .products-card { display: none !important; }

        .main-content { margin-left: 0 !important; background: #fff !important; }
        .page-content { padding: 0 !important; }
        body { background: #fff !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; margin: 0; }

        .print-order {
            display: block !important;
            padding: 10mm 15mm !important;
            font-family: 'Segoe UI', sans-serif;
            font-size: 12px;
            color: #1e293b;
            width: 165mm;
            max-width: 165mm;
            box-sizing: border-box;
            background: #fff;
            margin-left: 0; /* Ensures it is aligned left */
        }

        @page { size: A4 landscape; margin: 0; }

        .po-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 12px;
            border-bottom: 3px solid #1e3a8a;
            margin-bottom: 15px;
        }

        .po-company { font-size: 22px; font-weight: 900; color: #1e3a8a; letter-spacing: 0.5px; }
        .po-title { font-size: 16px; font-weight: 800; color: #1e3a8a; text-align: right; text-transform: uppercase; }
        .po-ref { font-size: 13px; font-weight: 700; color: #475569; text-align: right; margin-top: 2px; }

        .po-info-row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .po-info-box {
            flex: 1;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 14px;
            background: #fafbff;
        }

        .po-info-box-title {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #1e3a8a;
            margin-bottom: 8px;
            padding-bottom: 6px;
            border-bottom: 2px solid #dbeafe;
        }

        .po-info-line {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
            font-size: 12px;
        }

        .po-info-line .label { color: #64748b; font-weight: 600; }
        .po-info-line .value { font-weight: 800; color: #0f1e4a; text-transform: uppercase; }

        /* Products Table */
        .po-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .po-table thead th {
            background: #1e3a8a !important;
            color: #fff !important;
            padding: 8px 10px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: left;
        }

        .po-table thead th:nth-child(n+2) { text-align: center; }
        .po-table thead th:last-child { text-align: right; }

        .po-table tbody td {
            padding: 6px 10px;
            border-bottom: 1.5px solid #e2e8f0;
            font-size: 12px;
        }

        .po-table tbody td:nth-child(n+2) { text-align: center; }
        .po-table tbody td:last-child { text-align: right; font-weight: 800; color: #0f1e4a; }

        .po-table tbody tr:nth-child(even) { background: #f8fafc !important; }

        .po-table tfoot td {
            padding: 8px 10px;
            border-top: 3px solid #1e3a8a;
            font-size: 12px;
        }

        /* Footer */
        .po-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 20px;
            padding-top: 12px;
            border-top: 2px solid #1e3a8a;
        }

        .po-footer-brand {
            font-size: 11px;
            font-weight: 900;
            color: #1e3a8a;
            letter-spacing: 2px;
        }

        .po-signature {
            text-align: center;
            font-size: 11px;
            color: #64748b;
            font-weight: 600;
        }

        .po-signature-line {
            width: 160px;
            border-top: 1.5px solid #94a3b8;
            margin-top: 40px;
            padding-top: 6px;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-bag-check-fill me-2" style="color:var(--blue-500);"></i>Détails de la Commande</h2>
        <p>Commande <strong>{{ $commandeClient->numero_commande }}</strong></p>
    </div>
    <div class="header-actions">
        <a href="{{ route('commandes.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
        <button onclick="window.print()" class="btn-print">
            <i class="bi bi-printer-fill"></i> Imprimer
        </button>
        @if($commandeClient->statut !== 'Livrée' && $commandeClient->statut !== 'Livré')
            <a href="{{ route('commandes.edit', $commandeClient->id) }}" class="btn-edit-main">
                <i class="bi bi-pencil-fill"></i> Modifier
            </a>
        @endif
    </div>
</div>

<div class="detail-layout">

    <!-- Main Card -->
    <div>
        <div class="detail-card">
            <!-- Header -->
            <div class="detail-card-header">
                <div class="detail-avatar">
                    <i class="bi bi-bag-fill"></i>
                </div>
                <div class="detail-header-info">
                    <div class="detail-name">{{ $commandeClient->numero_commande }}</div>
                    <div class="detail-badges">
                        @if($commandeClient->client)
                            <span class="detail-badge">
                                <i class="bi bi-building"></i> {{ $commandeClient->client->nom_entreprise }}
                            </span>
                        @endif
                        <span class="detail-badge">
                            <i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($commandeClient->date_commande)->format('d/m/Y') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="detail-card-body">
                <!-- Client -->
                <div class="section-title"><i class="bi bi-person-fill"></i> Informations Client</div>
                <div class="info-grid">
                    <div class="info-field">
                        <div class="info-field-icon"><i class="bi bi-building"></i></div>
                        <div>
                            <div class="info-field-label">Entreprise</div>
                            <div class="info-field-value">{{ $commandeClient->client->nom_entreprise ?? '—' }}</div>
                        </div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-icon"><i class="bi bi-person"></i></div>
                        <div>
                            <div class="info-field-label">Contact</div>
                            <div class="info-field-value">{{ $commandeClient->client->personne_contact ?? '—' }}</div>
                        </div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-icon"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <div class="info-field-label">Téléphone</div>
                            <div class="info-field-value">{{ $commandeClient->client->telephone ?? '—' }}</div>
                        </div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-icon"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <div class="info-field-label">Email</div>
                            <div class="info-field-value">{{ $commandeClient->client->email ?? '—' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Livraison -->
                <div class="section-title" style="margin-top:1rem;"><i class="bi bi-truck"></i> Détails Livraison & Suivi</div>
                <div class="info-grid">
                    <div class="info-field">
                        <div class="info-field-icon"><i class="bi bi-calendar3"></i></div>
                        <div>
                            <div class="info-field-label">Date de commande</div>
                            <div class="info-field-value">{{ \Carbon\Carbon::parse($commandeClient->date_commande)->format('d/m/Y') }}</div>
                        </div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-icon"><i class="bi bi-calendar-check"></i></div>
                        <div>
                            <div class="info-field-label">Date de livraison</div>
                            <div class="info-field-value">{{ $commandeClient->date_livraison ? \Carbon\Carbon::parse($commandeClient->date_livraison)->format('d/m/Y') : '—' }}</div>
                        </div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-icon"><i class="bi bi-person-badge"></i></div>
                        <div>
                            <div class="info-field-label">Comptable</div>
                            <div class="info-field-value">{{ $commandeClient->comptable ? $commandeClient->comptable->nom_complet : 'Non assigné' }}</div>
                        </div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-icon"><i class="bi bi-truck-flatbed"></i></div>
                        <div>
                            <div class="info-field-label">Expédition / Chauffeur</div>
                            <div class="info-field-value">
                                @if($commandeClient->expedition)
                                    {{ $commandeClient->expedition->employes->nom_complet ?? 'N/A' }} 
                                    <span style="color:#64748b; font-size: 0.8rem; margin-left: 5px;">- {{ \Carbon\Carbon::parse($commandeClient->expedition->date_expedition)->format('d/m/Y') }}</span>
                                @else
                                    <span style="color:#94a3b8;">Non assignée</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($commandeClient->notes)
                        <div class="info-field">
                            <div class="info-field-icon"><i class="bi bi-sticky"></i></div>
                            <div>
                                <div class="info-field-label">Notes</div>
                                <div class="info-field-value" style="font-weight:500;color:#475569;">{{ $commandeClient->notes }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="products-card">
            <div class="products-header">
                <i class="bi bi-box-seam-fill" style="color:var(--blue-500);font-size:1.1rem;"></i>
                <h3>Articles / Produits</h3>
                <span class="count-badge">{{ count($commandeClient->details) }}</span>
            </div>
            <div style="overflow-x:auto;">
                <table class="products-table">
                    <thead>
                        <tr>
                            <th style="width:40%;"><i class="bi bi-box me-1"></i> Produit</th>
                            <th style="text-align:center;"><i class="bi bi-stack me-1"></i> Qté</th>
                            <th style="text-align:right;"><i class="bi bi-tag me-1"></i> Prix Unit.</th>
                            <th style="text-align:center;"><i class="bi bi-percent me-1"></i> Remise</th>
                            <th style="text-align:right;"><i class="bi bi-cash me-1"></i> Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($commandeClient->details as $detail)
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:0.5rem;">
                                        <div style="width:30px;height:30px;background:#eff6ff;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                            <i class="bi bi-box-fill" style="color:var(--blue-600);font-size:0.8rem;"></i>
                                        </div>
                                        <span style="font-weight:700;color:#0f1e4a;">{{ $detail->produit ? $detail->produit->nom_produit : 'Produit inconnu' }}</span>
                                    </div>
                                </td>
                                <td style="text-align:center;">
                                    <span style="background:#eff6ff;color:var(--blue-700);padding:3px 10px;border-radius:7px;font-weight:700;font-size:0.82rem;">{{ $detail->quantite }}</span>
                                </td>
                                <td style="text-align:right;font-weight:600;color:#64748b;">
                                    {{ number_format($detail->prix_unitaire, 2, ',', ' ') }} <span style="font-size:0.7rem;">DH</span>
                                </td>
                                <td style="text-align:center;font-weight:600;color:#ea580c;">
                                    {{ number_format($detail->remise ?? 0, 2) }}%
                                </td>
                                <td style="text-align:right;font-weight:800;color:#0f1e4a;">
                                    {{ number_format($detail->prix_total, 2, ',', ' ') }} <span style="font-size:0.7rem;color:#64748b;font-weight:500;">DH</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center;padding:3rem;color:#94a3b8;">
                                    <i class="bi bi-box-seam" style="font-size:1.5rem;display:block;margin-bottom:0.5rem;"></i>
                                    Aucun produit associé à cette commande.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td style="text-align:right;">
                                <span class="total-label">Total TTC :</span>
                            </td>
                            <td style="text-align:right;">
                                <span class="total-value">
                                    {{ number_format($commandeClient->montant_total, 2, ',', ' ') }}<span class="currency">DH</span>
                                </span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div>
        <div class="sidebar-card">
            <div class="sidebar-card-body">
                <div class="section-title"><i class="bi bi-flag-fill"></i> Statut</div>

                <div class="status-row">
                    @php
                        $sClass = match($commandeClient->statut) {
                            'Nouvelle' => 'nouvelle', 'En préparation' => 'preparation',
                            'Expédiée' => 'expediee', 'Livrée' => 'livree', 'Annulée' => 'annulee',
                            default => 'default'
                        };
                        $pClass = match($commandeClient->statut_paiement) {
                            'Payé' => 'paye', 'Partiellement payé' => 'partiel', 'Non payé' => 'non-paye',
                            default => 'default'
                        };
                    @endphp
                    <span class="badge-statut {{ $sClass }}">
                        <span class="dot"></span> {{ $commandeClient->statut ?? 'Non défini' }}
                    </span>
                    <span class="badge-statut {{ $pClass }}">
                        <span class="dot"></span> {{ $commandeClient->statut_paiement ?? 'Non défini' }}
                    </span>
                </div>

                <div class="summary-box">
                    <div class="summary-row">
                        <span class="label">Nb. Produits</span>
                        <span class="value">{{ count($commandeClient->details) }}</span>
                    </div>
                    <div class="summary-row total">
                        <span class="label">Montant Total</span>
                        <span class="value">{{ number_format($commandeClient->montant_total, 2, ',', ' ') }} DH</span>
                    </div>
                </div>

                <div class="sidebar-actions">
                    @if($commandeClient->statut !== 'Livrée' && $commandeClient->statut !== 'Livré')
                        <a href="{{ route('commandes.edit', $commandeClient->id) }}" class="sidebar-btn sidebar-btn-edit">
                            <i class="bi bi-pencil-fill"></i> Modifier
                        </a>
                        <form action="{{ route('commandes.destroy', $commandeClient->id) }}" method="POST"
                            onsubmit="return confirm('Supprimer cette commande ?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="sidebar-btn sidebar-btn-delete">
                                <i class="bi bi-trash-fill"></i> Supprimer
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('commandes.index') }}" class="sidebar-btn sidebar-btn-back">
                        <i class="bi bi-arrow-return-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ══════════════════════════════════════ -->
<!-- PRINT-ONLY: Bon de Livraison (A5 LR) -->
<!-- ══════════════════════════════════════ -->
<div class="print-order" style="margin-left:-50px">
    <div class="po-header" >
        <div class="po-company">STE SOFREBAK</div>
        <div>
            <div class="po-title">BON DE LIVRAISON</div>
            <div class="po-ref">N° : {{ $commandeClient->numero_commande }}</div>
        </div>
    </div>

    <div class="po-info-row">
        <div class="po-info-box">
            <div class="po-info-box-title">Client</div>
            @if($commandeClient->client)
                <div class="po-info-line">
                    <span class="label">Nom :</span>
                    <span class="value">{{ $commandeClient->client->personne_contact }}</span>
                </div>
                <div class="po-info-line">
                    <span class="label">Téléphone :</span>
                    <span class="value">{{ $commandeClient->client->telephone }}</span>
                </div>
            @endif
        </div>
        <div class="po-info-box">
            <div class="po-info-box-title">Détails</div>
            <div class="po-info-line">
                <span class="label">Date :</span>
                <span class="value">{{ $commandeClient->date_livraison ? \Carbon\Carbon::parse($commandeClient->date_livraison)->format('d/m/Y') : \Carbon\Carbon::parse($commandeClient->date_commande)->format('d/m/Y') }}</span>
            </div>
            <div class="po-info-line">
                <span class="label">Représentant :</span>
                <span class="value">{{ $commandeClient->comptable ? $commandeClient->comptable->nom_complet : 'Non assigné' }}</span>
            </div>
            <div class="po-info-line">
                <span class="label">Livreur :</span>
                <span class="value">{{ $commandeClient->expedition->employes->nom_complet ?? 'Non assigné' }}</span>
            </div>
        </div>
    </div>

    <table class="po-table fs-6">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Qté</th>
                <th>Prix Unit.</th>
                <th>Remise</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commandeClient->details as $detail)
                <tr>
                    <td>{{ $detail->produit ? $detail->produit->nom_produit : 'Produit inconnu' }}</td>
                    <td>{{ $detail->quantite }}</td>
                    <td>{{ number_format($detail->prix_unitaire, 2, ',', ' ') }}</td>
                    <td>{{ number_format($detail->remise ?? 0, 2) }}%</td>
                    <td>{{ number_format($detail->prix_total, 2, ',', ' ') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td style="text-align:right;font-weight:900;font-size:14px">Total TTC :</td>
                <td style="text-align:right;font-weight:900;font-size:14px;">{{ number_format($commandeClient->montant_total, 2, ',', ' ') }} DH</td>
            </tr>
        </tfoot>
    </table>

    <div class="po-footer">
        <div class="po-footer-brand">STE SOFREBAK</div>
        <div class="po-signature">
            <div class="po-signature-line">Signature Client</div>
        </div>
    </div>

    <div style="display: fixed; margin-top: 32%; text-align: center; border-top: 1px dashed #cbd5e1; padding-top: 10px; font-size: 11pt; color: #475569; font-weight: 600; width: 100%;">
        Veuillez contrôler vos marchandises avec le livreur
        <br>Aucune réclamation ne sera acceptée après 24h de la date de livraison
    </div>
</div>
@endsection