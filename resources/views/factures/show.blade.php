@extends('_layout')

@section('title', 'Facture - ' . $facture->numero_facture)

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
        box-shadow: 0 1px 4px rgba(15,42,110,0.05);
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
        text-decoration: none;
        border: 1.5px solid #ddd6fe;
        transition: all 0.2s ease;
        cursor: pointer;
        border: none;
    }

    .btn-print:hover {
        background: #7c3aed;
        color: #fff;
        transform: translateY(-1px);
    }

    /* ── Detail Layout ── */
    .detail-layout {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 1.4rem;
    }

    /* ── Detail Card ── */
    .detail-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    .detail-card:hover {
        box-shadow: 0 8px 28px rgba(29,78,216,0.1);
    }

    /* Card Header */
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

    .detail-card-header::after {
        content: '';
        position: absolute;
        bottom: -60px; left: -30px;
        width: 120px; height: 120px;
        background: rgba(255,255,255,0.03);
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

    .detail-avatar i {
        color: #fff;
        font-size: 1.5rem;
    }

    .detail-header-info {
        flex: 1; min-width: 0;
        position: relative; z-index: 1;
    }

    .detail-name {
        font-size: 1.2rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 6px;
    }

    .detail-badges {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

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
    .detail-card-body {
        padding: 1.5rem 1.8rem;
    }

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

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
    }

    .detail-field {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        padding: 0.9rem 0.5rem;
        border-bottom: 1px solid #f1f5fb;
        transition: background 0.2s ease;
        border-radius: 10px;
        margin: 0 -0.5rem;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .detail-field:hover { background: #f8faff; }

    .detail-field.full-width { grid-column: 1 / -1; }

    .detail-field-icon {
        width: 36px; height: 36px;
        background: #eff6ff;
        border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        margin-top: 2px;
        transition: all 0.2s ease;
    }

    .detail-field:hover .detail-field-icon { background: var(--blue-500); }
    .detail-field-icon i { color: var(--blue-600); font-size: 0.9rem; transition: color 0.2s ease; }
    .detail-field:hover .detail-field-icon i { color: #fff; }

    .detail-field-content { flex: 1; min-width: 0; }

    .detail-field-label {
        font-size: 0.66rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #94a3b8;
        line-height: 1;
        margin-bottom: 4px;
    }

    .detail-field-value {
        font-size: 0.9rem;
        font-weight: 600;
        color: #1e293b;
        word-break: break-word;
        line-height: 1.4;
    }

    /* ── Sidebar Card ── */
    .sidebar-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        overflow: hidden;
    }

    .sidebar-card-body {
        padding: 1.4rem;
    }

    /* Statut Badge */
    .statut-display {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.2rem;
    }

    .badge-statut-lg {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.2rem;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 800;
    }

    .badge-statut-lg .dot {
        width: 10px; height: 10px;
        border-radius: 50%;
        background: currentColor;
    }

    .badge-statut-lg.payee       { background: #f0fdf4; color: #16a34a; border: 1.5px solid #bbf7d0; }
    .badge-statut-lg.partielle   { background: #fff7ed; color: #ea580c; border: 1.5px solid #fed7aa; }
    .badge-statut-lg.non-payee   { background: #fef2f2; color: #ef4444; border: 1.5px solid #fecaca; }
    .badge-statut-lg.annulee     { background: #f8fafc; color: #64748b; border: 1.5px solid #e2e8f0; }
    .badge-statut-lg.default     { background: #eff6ff; color: var(--blue-600); border: 1.5px solid #bfdbfe; }

    /* Payment Progress */
    .payment-summary {
        background: #f8faff;
        border: 1px solid #e2eaf8;
        border-radius: 14px;
        padding: 1.1rem;
        margin-bottom: 1rem;
    }

    .payment-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.4rem 0;
        font-size: 0.84rem;
    }

    .payment-row .label { color: #64748b; font-weight: 500; }
    .payment-row .value { font-weight: 700; color: #1e293b; }
    .payment-row.total { border-top: 2px solid #e2eaf8; padding-top: 0.7rem; margin-top: 0.4rem; }
    .payment-row.total .label { font-weight: 700; color: #0f1e4a; font-size: 0.88rem; }
    .payment-row.total .value { color: var(--blue-700); font-size: 1.05rem; }

    .payment-row.paid .value { color: #16a34a; }
    .payment-row.remaining .value { color: #ef4444; }

    /* Progress bar */
    .progress-container {
        margin-top: 0.8rem;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.72rem;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 0.3rem;
    }

    .progress-bar-bg {
        width: 100%;
        height: 8px;
        background: #e2eaf8;
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        border-radius: 4px;
        transition: width 0.5s ease;
    }

    .progress-bar-fill.green  { background: linear-gradient(90deg, #16a34a, #22c55e); }
    .progress-bar-fill.orange { background: linear-gradient(90deg, #ea580c, #f97316); }
    .progress-bar-fill.red    { background: linear-gradient(90deg, #ef4444, #f87171); }

    /* Sidebar Actions */
    .sidebar-actions {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-top: 1rem;
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

    .sidebar-btn-edit {
        background: #eff6ff;
        color: var(--blue-600);
        border: 1.5px solid #bfdbfe;
    }
    .sidebar-btn-edit:hover {
        background: var(--blue-600); color: #fff; border-color: var(--blue-600);
        box-shadow: 0 4px 14px rgba(29,78,216,0.3);
        transform: translateY(-1px);
    }

    .sidebar-btn-delete {
        background: #fff5f5;
        color: #ef4444;
        border: 1.5px solid #fecaca;
    }
    .sidebar-btn-delete:hover {
        background: #ef4444; color: #fff; border-color: #ef4444;
        box-shadow: 0 4px 14px rgba(239,68,68,0.3);
        transform: translateY(-1px);
    }

    .sidebar-btn-back {
        background: #f8fafc;
        color: #64748b;
        border: 1.5px solid #e2eaf8;
    }
    .sidebar-btn-back:hover {
        background: #e2eaf8; color: #475569; border-color: #cbd5e1;
        transform: translateY(-1px);
    }

    /* ── Responsive ── */
    @media (max-width: 900px) {
        .detail-layout {
            grid-template-columns: 1fr;
        }

        .header-actions {
            width: 100%;
        }

        .header-actions a,
        .header-actions button {
            flex: 1;
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-card-header {
            padding: 1.2rem 1.3rem;
        }

        .detail-card-body {
            padding: 1rem 1.3rem;
        }

        .detail-name { font-size: 1rem; }
        .detail-avatar { width: 48px; height: 48px; }
        .detail-avatar i { font-size: 1.2rem; }
    }

    /* ── Print ── */
    .print-invoice { display: none; }

    @media print {
        /* Hide everything from the web UI */
        .sidebar, .top-bar, .page-header, .detail-layout { display: none !important; }

        .main-content {
            margin-left: 0 !important;
            background: #fff !important;
        }

        .page-content {
            padding: 0 !important;
        }

        body {
            background: #fff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Show print invoice */
        .print-invoice {
            display: block !important;
            padding: 0;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
            font-size: 11px;
            color: #1e293b;
        }

        .print-invoice * {
            box-sizing: border-box;
        }

        /* Invoice Header */
        .inv-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 20px;
            border-bottom: 3px solid #1e3a8a;
            margin-bottom: 24px;
        }

        .inv-company {
            flex: 1;
        }

        .inv-company-name {
            font-size: 22px;
            font-weight: 800;
            color: #1e3a8a;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }

        .inv-company-sub {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
        }

        .inv-title-box {
            text-align: right;
        }

        .inv-title {
            font-size: 28px;
            font-weight: 800;
            color: #1e3a8a;
            text-transform: uppercase;
            letter-spacing: 3px;
            line-height: 1;
            margin-bottom: 8px;
        }

        .inv-ref {
            font-size: 13px;
            font-weight: 700;
            color: #475569;
        }

        .inv-ref strong {
            color: #1e3a8a;
        }

        /* Info Boxes */
        .inv-info-row {
            display: flex;
            gap: 24px;
            margin-bottom: 24px;
        }

        .inv-info-box {
            flex: 1;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px 16px;
        }

        .inv-info-box-title {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #1e3a8a;
            margin-bottom: 8px;
            padding-bottom: 6px;
            border-bottom: 1.5px solid #dbeafe;
        }

        .inv-info-line {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
            font-size: 11px;
        }

        .inv-info-line .label {
            color: #64748b;
            font-weight: 500;
        }

        .inv-info-line .value {
            font-weight: 700;
            color: #1e293b;
            text-align: right;
        }

        /* Amounts Table */
        .inv-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        .inv-table thead th {
            background: #1e3a8a !important;
            color: #fff !important;
            padding: 10px 14px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: left;
        }

        .inv-table thead th:last-child {
            text-align: right;
        }

        .inv-table tbody td {
            padding: 10px 14px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
        }

        .inv-table tbody td:last-child {
            text-align: right;
            font-weight: 700;
        }

        .inv-table tbody tr:nth-child(even) {
            background: #f8fafc !important;
        }

        /* Total Section */
        .inv-totals {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 30px;
        }

        .inv-totals-box {
            width: 280px;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .inv-total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 16px;
            font-size: 11px;
            border-bottom: 1px solid #f1f5f9;
        }

        .inv-total-row .label {
            color: #64748b;
            font-weight: 500;
        }

        .inv-total-row .value {
            font-weight: 700;
            color: #1e293b;
        }

        .inv-total-row.grand {
            background: #1e3a8a !important;
            border-bottom: none;
        }

        .inv-total-row.grand .label {
            color: #fff !important;
            font-weight: 700;
            font-size: 12px;
        }

        .inv-total-row.grand .value {
            color: #fff !important;
            font-weight: 800;
            font-size: 14px;
        }

        .inv-total-row.paid .value {
            color: #16a34a;
        }

        .inv-total-row.remaining .value {
            color: #ef4444;
        }

        /* Status */
        .inv-status {
            text-align: center;
            margin-bottom: 24px;
        }

        .inv-status-badge {
            display: inline-block;
            padding: 6px 24px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            border: 2px solid;
        }

        .inv-status-badge.payee       { color: #16a34a; border-color: #16a34a; background: #f0fdf4 !important; }
        .inv-status-badge.partielle   { color: #ea580c; border-color: #ea580c; background: #fff7ed !important; }
        .inv-status-badge.non-payee   { color: #ef4444; border-color: #ef4444; background: #fef2f2 !important; }
        .inv-status-badge.annulee     { color: #64748b; border-color: #94a3b8; background: #f8fafc !important; }

        /* Footer */
        .inv-footer {
            border-top: 2px solid #1e3a8a;
            padding-top: 12px;
            text-align: center;
        }

        .inv-footer p {
            font-size: 9px;
            color: #94a3b8;
            margin: 2px 0;
            letter-spacing: 0.5px;
        }

        .inv-footer .brand {
            font-size: 10px;
            font-weight: 800;
            color: #1e3a8a;
            letter-spacing: 2px;
        }

        @page {
            size: A4;
            margin: 0;
        }

        .print-invoice {
            padding: 15mm 18mm !important;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-receipt-cutoff me-2" style="color:var(--blue-500);"></i>Détails de la Facture</h2>
        <p>Facture <strong>{{ $facture->numero_facture }}</strong></p>
    </div>
    <div class="header-actions">
        <a href="{{ route('factures.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
        <button onclick="window.print()" class="btn-print">
            <i class="bi bi-printer-fill"></i> Imprimer
        </button>
        <a href="{{ route('factures.edit', $facture->id) }}" class="btn-edit-main">
            <i class="bi bi-pencil-fill"></i> Modifier
        </a>
    </div>
</div>

<div class="detail-layout">

    <!-- Main Detail Card -->
    <div class="detail-card">
        <!-- Header -->
        <div class="detail-card-header">
            <div class="detail-avatar">
                <i class="bi bi-receipt-cutoff"></i>
            </div>
            <div class="detail-header-info">
                <div class="detail-name">{{ $facture->numero_facture }}</div>
                <div class="detail-badges">
                    @if($facture->client)
                        <span class="detail-badge">
                            <i class="bi bi-person-fill"></i> {{ $facture->client->nom_entreprise }}
                        </span>
                    @endif
                    <span class="detail-badge">
                        <i class="bi bi-calendar3"></i> {{ $facture->date_facture ? \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') : '—' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="detail-card-body">

            <!-- Section: Client & Référence -->
            <div class="section-title">
                <i class="bi bi-person-fill"></i> Client & Référence
            </div>
            <div class="detail-grid">
                <div class="detail-field">
                    <div class="detail-field-icon"><i class="bi bi-hash"></i></div>
                    <div class="detail-field-content">
                        <div class="detail-field-label">N° Facture</div>
                        <div class="detail-field-value">{{ $facture->numero_facture }}</div>
                    </div>
                </div>
                <div class="detail-field">
                    <div class="detail-field-icon"><i class="bi bi-person-fill"></i></div>
                    <div class="detail-field-content">
                        <div class="detail-field-label">Client</div>
                        <div class="detail-field-value">
                            @if($facture->client)
                                {{ $facture->client->nom_entreprise }}
                            @else
                                —
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Dates -->
            <div class="section-title" style="margin-top:1rem;">
                <i class="bi bi-calendar3"></i> Dates
            </div>
            <div class="detail-grid">
                <div class="detail-field">
                    <div class="detail-field-icon"><i class="bi bi-calendar-event"></i></div>
                    <div class="detail-field-content">
                        <div class="detail-field-label">Date de Facture</div>
                        <div class="detail-field-value">
                            {{ $facture->date_facture ? \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') : '—' }}
                        </div>
                    </div>
                </div>
                <div class="detail-field">
                    <div class="detail-field-icon"><i class="bi bi-calendar-check"></i></div>
                    <div class="detail-field-content">
                        <div class="detail-field-label">Date d'Échéance</div>
                        <div class="detail-field-value">
                            @if($facture->date_echeance)
                                @php
                                    $echeance = \Carbon\Carbon::parse($facture->date_echeance);
                                    $isOverdue = $echeance->isPast() && $facture->statut !== 'Payée';
                                @endphp
                                <span style="{{ $isOverdue ? 'color:#ef4444;' : '' }}">
                                    {{ $echeance->format('d/m/Y') }}
                                    @if($isOverdue)
                                        <i class="bi bi-exclamation-triangle-fill" style="font-size:0.75rem;margin-left:3px;"></i>
                                        <span style="font-size:0.72rem;font-weight:700;margin-left:4px;">En retard</span>
                                    @endif
                                </span>
                            @else
                                —
                            @endif
                        </div>
                    </div>
                </div>
                <div class="detail-field">
                    <div class="detail-field-icon"><i class="bi bi-calendar-check-fill"></i></div>
                    <div class="detail-field-content">
                        <div class="detail-field-label">Date de Règlement</div>
                        <div class="detail-field-value">
                            {{ $facture->date_reglement ? \Carbon\Carbon::parse($facture->date_reglement)->format('d/m/Y') : '—' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Montants -->
            <div class="section-title" style="margin-top:1rem;">
                <i class="bi bi-cash-stack"></i> Détails Financiers
            </div>
            <div class="detail-grid">
                <div class="detail-field">
                    <div class="detail-field-icon"><i class="bi bi-calculator"></i></div>
                    <div class="detail-field-content">
                        <div class="detail-field-label">Sous Total</div>
                        <div class="detail-field-value" style="font-weight:800;">
                            {{ number_format($facture->sous_total, 2, ',', ' ') }}
                            <span style="font-size:0.72rem;color:#64748b;font-weight:500;">DH</span>
                        </div>
                    </div>
                </div>
                <div class="detail-field">
                    <div class="detail-field-icon"><i class="bi bi-percent"></i></div>
                    <div class="detail-field-content">
                        <div class="detail-field-label">Montant TVA 20%</div>
                        <div class="detail-field-value" style="font-weight:800;">
                            {{ number_format($facture->montant_tva, 2, ',', ' ') }}
                            <span style="font-size:0.72rem;color:#64748b;font-weight:500;">DH</span>
                        </div>
                    </div>
                </div>
                <div class="detail-field">
                    <div class="detail-field-icon"><i class="bi bi-cash"></i></div>
                    <div class="detail-field-content">
                        <div class="detail-field-label">Montant Total</div>
                        <div class="detail-field-value" style="font-weight:800;color:var(--blue-700);font-size:1rem;">
                            {{ number_format($facture->montant_total, 2, ',', ' ') }}
                            <span style="font-size:0.75rem;color:#64748b;font-weight:500;">DH</span>
                        </div>
                    </div>
                </div>
                <div class="detail-field">
                    <div class="detail-field-icon"><i class="bi bi-wallet2"></i></div>
                    <div class="detail-field-content">
                        <div class="detail-field-label">Montant Payé</div>
                        <div class="detail-field-value" style="font-weight:800;color:#16a34a;">
                            {{ number_format($facture->montant_paye ?? 0, 2, ',', ' ') }}
                            <span style="font-size:0.72rem;color:#64748b;font-weight:500;">DH</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div>
        <!-- Status & Payment Card -->
        <div class="sidebar-card" style="margin-bottom:1rem;">
            <div class="sidebar-card-body">
                <div class="section-title">
                    <i class="bi bi-flag-fill"></i> Statut
                </div>

                <div class="statut-display">
                    @php
                        $statutClass = match($facture->statut) {
                            'Payée' => 'payee',
                            'Partiellement payée' => 'partielle',
                            'Non payée' => 'non-payee',
                            'Annulée' => 'annulee',
                            default => 'default'
                        };
                    @endphp
                    <span class="badge-statut-lg {{ $statutClass }}">
                        <span class="dot"></span>
                        {{ $facture->statut ?? 'Non défini' }}
                    </span>
                </div>

                <div class="payment-summary">
                    <div class="payment-row">
                        <span class="label">Sous Total</span>
                        <span class="value">{{ number_format($facture->sous_total, 2, ',', ' ') }} DH</span>
                    </div>
                    <div class="payment-row">
                        <span class="label">TVA 20% :</span>
                        <span class="value">{{ number_format($facture->montant_tva, 2, ',', ' ') }} DH</span>
                    </div>
                    <div class="payment-row total">
                        <span class="label">Total</span>
                        <span class="value">{{ number_format($facture->montant_total, 2, ',', ' ') }} DH</span>
                    </div>
                    <div class="payment-row paid">
                        <span class="label">Payé</span>
                        <span class="value">{{ number_format($facture->montant_paye ?? 0, 2, ',', ' ') }} DH</span>
                    </div>
                    @php
                        $restant = ($facture->montant_total ?? 0) - ($facture->montant_paye ?? 0);
                    @endphp
                    @if($restant > 0)
                        <div class="payment-row remaining">
                            <span class="label">Restant</span>
                            <span class="value">{{ number_format($restant, 2, ',', ' ') }} DH</span>
                        </div>
                    @endif

                    @php
                        $paye = $facture->montant_paye ?? 0;
                        $total = $facture->montant_total ?? 1;
                        $percent = $total > 0 ? min(100, round(($paye / $total) * 100)) : 0;
                        $barColor = $percent >= 100 ? 'green' : ($percent > 0 ? 'orange' : 'red');
                    @endphp
                    <div class="progress-container">
                        <div class="progress-label">
                            <span>Paiement</span>
                            <span>{{ $percent }}%</span>
                        </div>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill {{ $barColor }}" style="width:{{ $percent }}%;"></div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-actions">
                    <a href="{{ route('factures.edit', $facture->id) }}" class="sidebar-btn sidebar-btn-edit">
                        <i class="bi bi-pencil-fill"></i> Modifier la facture
                    </a>
                    <form action="{{ route('factures.destroy', $facture->id) }}" method="POST"
                          onsubmit="return confirm('Voulez-vous vraiment supprimer cette facture ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="sidebar-btn sidebar-btn-delete">
                            <i class="bi bi-trash-fill"></i> Supprimer
                        </button>
                    </form>
                    <a href="{{ route('factures.index') }}" class="sidebar-btn sidebar-btn-back">
                        <i class="bi bi-arrow-return-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════ -->
<!-- PRINT-ONLY INVOICE (hidden on screen, shown on print)  -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="print-invoice">

    <!-- Invoice Header -->
    <div class="inv-header">
        <div class="inv-company">
            <div class="inv-company-name">STE SOFREBAK</div>
            <div class="inv-company-sub">Gestion Commerciale</div>
        </div>
        <div class="inv-title-box">
            <div class="inv-title">Facture</div>
            <div class="inv-ref">N° : <strong>{{ $facture->numero_facture }}</strong></div>
        </div>
    </div>

    <!-- Info Row -->
    <div class="inv-info-row">
        <!-- Client Info -->
        <div class="inv-info-box">
            <div class="inv-info-box-title">Client</div>
            @if($facture->client)
                <div class="inv-info-line">
                    <span class="label">Entreprise :</span>
                    <span class="value">{{ $facture->client->nom_entreprise ?? '—' }}</span>
                </div>
                <div class="inv-info-line">
                    <span class="label">Contact :</span>
                    <span class="value">{{ $facture->client->personne_contact ?? '—' }}</span>
                </div>
                <div class="inv-info-line">
                    <span class="label">Tél :</span>
                    <span class="value">{{ $facture->client->telephone ?? '—' }}</span>
                </div>
            @else
                <div class="inv-info-line">
                    <span class="label">Client</span>
                    <span class="value">—</span>
                </div>
            @endif
        </div>

        <!-- Facture Info -->
        <div class="inv-info-box">
            <div class="inv-info-box-title">Détails Facture</div>
            <div class="inv-info-line">
                <span class="label">N° Facture :</span>
                <span class="value">{{ $facture->numero_facture }}</span>
            </div>
            <div class="inv-info-line">
                <span class="label">Date Facture :</span>
                <span class="value">{{ $facture->date_facture ? \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') : '—' }}</span>
            </div>
            <div class="inv-info-line">
                <span class="label">Échéance :</span>
                <span class="value">{{ $facture->date_echeance ? \Carbon\Carbon::parse($facture->date_echeance)->format('d/m/Y') : '—' }}</span>
            </div>
            <div class="inv-info-line">
                <span class="label">Date de Règlement :</span>
                <span class="value">{{ $facture->date_reglement ? \Carbon\Carbon::parse($facture->date_reglement)->format('d/m/Y') : '—' }}</span>
            </div>
        </div>
    </div>

    <!-- Amounts Table -->
    <table class="inv-table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>TVA 20% :</td>
                <td>{{ number_format($facture->montant_tva, 2, ',', ' ') }} DH</td>
            </tr>
        </tbody>
    </table>

    <!-- Totals -->
    <div class="inv-totals">
        <div class="inv-totals-box">
            <div class="inv-total-row">
                <span class="label">TVA 20% :</span>
                <span class="value">{{ number_format($facture->montant_tva, 2, ',', ' ') }} DH</span>
            </div>
            <div class="inv-total-row grand">
                <span class="label">TOTAL TTC</span>
                <span class="value">{{ number_format($facture->montant_total, 2, ',', ' ') }} DH</span>
            </div>
            <div class="inv-total-row paid">
                <span class="label">Montant Payé</span>
                <span class="value">{{ number_format($facture->montant_paye ?? 0, 2, ',', ' ') }} DH</span>
            </div>
            @php $restant = ($facture->montant_total ?? 0) - ($facture->montant_paye ?? 0); @endphp
            @if($restant > 0)
                <div class="inv-total-row remaining">
                    <span class="label">Restant à Payer</span>
                    <span class="value">{{ number_format($restant, 2, ',', ' ') }} DH</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Status -->
    <div class="inv-status">
        @php
            $printStatutClass = match($facture->statut) {
                'Payée' => 'payee',
                'Partiellement payée' => 'partielle',
                'Non payée' => 'non-payee',
                'Annulée' => 'annulee',
                default => 'non-payee'
            };
        @endphp
        <span class="inv-status-badge {{ $printStatutClass }}">
            {{ $facture->statut ?? 'Non défini' }}
        </span>
    </div>

    <!-- Footer -->
    <div class="inv-footer">
        <p class="brand">SOFREBAK</p>
        <p>Facture {{ $facture->numero_facture }}</p>
    </div>
</div>
@endsection