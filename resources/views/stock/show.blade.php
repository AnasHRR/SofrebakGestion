@extends('_layout')
@section('title', 'Détails du Mouvement de Stock')
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

    .badge-stock {
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }
    .badge-stock.entree { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .badge-stock.sortie { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    .badge-stock.ajustement { background: #ffedd5; color: #9a3412; border: 1px solid #fed7aa; }

</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-info-circle-fill me-2" style="color:var(--blue-500);"></i>Détails du Mouvement</h2>
        <p>Informations complètes sur le mouvement de stock #{{ $stock->id }}</p>
    </div>
    
    <div>
        <a href="{{ route('stock.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>

<div class="detail-card">
    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-hash me-1"></i> ID du Mouvement</div>
        <div class="detail-value">#{{ $stock->id }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-box me-1"></i> Produit Associé</div>
        <div class="detail-value">
            <div style="display: flex; align-items: center; gap: 0.8rem;">
                <div style="width: 38px; height: 38px; background: #eff6ff; display: flex; align-items: center; justify-content: center; border-radius: 10px; flex-shrink: 0;">
                    <i class="bi bi-box-seam" style="color: var(--blue-600); font-size: 1.1rem;"></i>
                </div>
                {{ $stock->produits ? $stock->produits->nom_produit : 'Produit inconnu' }}
            </div>
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-arrow-left-right me-1"></i> Type de Mouvement</div>
        <div class="detail-value">
            @if($stock->type_mouvement == 'Entrée')
                <span class="badge-stock entree"><i class="bi bi-box-arrow-in-right"></i> {{ $stock->type_mouvement }}</span>
            @elseif($stock->type_mouvement == 'Sortie')
                <span class="badge-stock sortie"><i class="bi bi-box-arrow-right"></i> {{ $stock->type_mouvement }}</span>
            @else
                <span class="badge-stock ajustement"><i class="bi bi-sliders"></i> {{ $stock->type_mouvement }}</span>
            @endif
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-123 me-1"></i> Quantité</div>
        <div class="detail-value" style="font-size: 1.2rem; font-weight: 800; color: {{ $stock->type_mouvement == 'Sortie' ? '#dc2626' : '#16a34a' }};">
            {{ $stock->type_mouvement == 'Sortie' ? '-' : '+' }}{{ $stock->quantite }}
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-calendar me-1"></i> Date d'Enregistrement</div>
        <div class="detail-value">
            {{ \Carbon\Carbon::parse($stock->date_mouvement)->format('d/m/Y') }}
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-upc-scan me-1"></i> Référence Document</div>
        <div class="detail-value">
            @if($stock->reference_id)
                <span style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 0.3rem 0.6rem; border-radius: 6px; font-family: monospace; font-size: 0.9rem;">{{ $stock->reference_id }}</span>
            @else
                <span style="color: #94a3b8; font-style: italic;">Aucune référence n'a été spécifiée</span>
            @endif
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label"><i class="bi bi-file-text me-1"></i> Notes / Observations</div>
        <div class="detail-value" style="line-height: 1.5; color: {{ $stock->notes ? '#334155' : '#94a3b8; font-style: italic;' }}">
            {{ $stock->notes ?: 'Aucune note n\'a été ajoutée pour ce mouvement.' }}
        </div>
    </div>
</div>

@endsection
