@extends('_layout')
@section('title', 'Détails de la Commande')
@section('content')

<style>
    /* ── Page Header ── */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.6rem;
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

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: #f1f5f9;
        color: #475569;
        font-size: 0.84rem;
        font-weight: 700;
        padding: 0.55rem 1.1rem;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1px solid #e2e8f0;
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    /* ── Card ── */
    .detail-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        padding: 2rem;
        max-width: 800px;
    }

    .detail-row {
        display: flex;
        margin-bottom: 1.2rem;
        padding-bottom: 1.2rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .detail-row:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .detail-label {
        width: 35%;
        color: #64748b;
        font-size: 0.88rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
    }

    .detail-value {
        width: 65%;
        color: #1e293b;
        font-size: 1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    .badge-statut {
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .badge-statut.attente { background: #fef08a; color: #854d0e; border: 1px solid #fde047; }
    .badge-statut.livree { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .badge-statut.annulee { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-info-circle-fill me-2" style="color:var(--blue-500);"></i>Détails de la Commande</h2>
        <p>Informations complètes sur la commande fournisseur #{{ $commandesFournisseur->id }}</p>
    </div>
    
    <div>
        <a href="{{ route('commandesFournisseurs.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>

<div class="detail-card">
    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-hash me-1"></i> Numéro de Commande</div>
        <div class="detail-value">#{{ $commandesFournisseur->id }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-calendar-event me-1"></i> Date d'Émission</div>
        <div class="detail-value">
            {{ \Carbon\Carbon::parse($commandesFournisseur->date_commande)->format('d/m/Y') }}
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-truck me-1"></i> Fournisseur</div>
        <div class="detail-value">
            <div style="display: flex; align-items: center; gap: 0.8rem;">
                <div style="width: 38px; height: 38px; background: #eff6ff; display: flex; align-items: center; justify-content: center; border-radius: 10px; flex-shrink: 0;">
                    <i class="bi bi-shop" style="color: var(--blue-600); font-size: 1.1rem;"></i>
                </div>
                {{ $commandesFournisseur->fournisseur ? $commandesFournisseur->fournisseur->nom : 'Fournisseur inconnu' }}
            </div>
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-person-badge me-1"></i> Employé Responsable</div>
        <div class="detail-value">
            {{ $commandesFournisseur->employe ? $commandesFournisseur->employe->nom_complet : 'Employé inconnu' }}
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-currency-dollar me-1"></i> Montant Total</div>
        <div class="detail-value" style="font-size: 1.25rem; font-weight: 800; color: #0f1e4a;">
            {{ number_format($commandesFournisseur->montant_total, 2, ',', ' ') }} DH
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-flag me-1"></i> Statut Actuel</div>
        <div class="detail-value">
            @php
                $statusClass = 'attente';
                $icon = 'bi-clock';
                if(strtolower($commandesFournisseur->statut) == 'livrée' || strtolower($commandesFournisseur->statut) == 'livree') {
                    $statusClass = 'livree';
                    $icon = 'bi-check-circle';
                } elseif(strtolower($commandesFournisseur->statut) == 'annulée' || strtolower($commandesFournisseur->statut) == 'annulee') {
                    $statusClass = 'annulee';
                    $icon = 'bi-x-circle';
                }
            @endphp
            <span class="badge-statut {{ $statusClass }}">
                <i class="bi {{ $icon }}"></i> {{ ucfirst($commandesFournisseur->statut) }}
            </span>
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-file-text me-1"></i> Notes / Observations</div>
        <div class="detail-value" style="line-height: 1.5; color: {{ $commandesFournisseur->notes ? '#334155' : '#94a3b8; font-style: italic;' }}">
            {{ $commandesFournisseur->notes ?: 'Aucune note n\'a été ajoutée pour cette commande.' }}
        </div>
    </div>
</div>

@endsection
