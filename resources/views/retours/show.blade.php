@extends('_layout')

@section('title', 'Détails du Retour - Sofrebak')

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

    .btn-action {
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

    .btn-action:hover {
        background: #f8fafc;
        color: var(--blue-600);
        border-color: var(--blue-200);
    }

    .btn-edit-main {
        background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
        color: #fff;
        border: none;
        box-shadow: 0 4px 12px rgba(29, 78, 216, 0.25);
    }

    .btn-edit-main:hover {
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(29, 78, 216, 0.35);
    }

    /* ── Detail Cards ── */
    .detail-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        overflow: hidden;
        height: 100%;
    }

    .detail-card-header {
        background: #fafbff;
        padding: 1.2rem 1.5rem;
        border-bottom: 1.5px solid #e2eaf8;
        display: flex;
        align-items: center;
        gap: 0.7rem;
    }

    .detail-card-header h6 {
        margin: 0;
        font-weight: 800;
        color: #0f1e4a;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-card-body {
        padding: 1.5rem;
    }

    .info-label {
        font-size: 0.72rem;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 0.3rem;
        display: block;
    }

    .info-value {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1e293b;
        display: block;
        margin-bottom: 1.2rem;
    }

    .motif-box {
        background: #f8fafc;
        border: 1.5px solid #e2eaf8;
        border-radius: 12px;
        padding: 1rem;
        color: #475569;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .badge-qty {
        background: var(--blue-50);
        color: var(--blue-700);
        padding: 0.5rem 1rem;
        border-radius: 10px;
        font-size: 1.2rem;
        font-weight: 800;
        border: 1.5px solid var(--blue-100);
        display: inline-block;
    }
</style>

<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-eye-fill me-2" style="color:var(--blue-500);"></i>Détails Retour #{{ $retour->id }}</h2>
        <p>Consultation des informations du retour</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('retours.index') }}" class="btn-action">
            <i class="bi bi-arrow-left me-1"></i> Retour à la liste
        </a>
        <a href="{{ route('retours.edit', $retour->id) }}" class="btn-action btn-edit-main">
            <i class="bi bi-pencil-square me-1"></i> Modifier
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Main Info -->
    <div class="col-lg-8">
        <div class="detail-card">
            <div class="detail-card-header">
                <i class="bi bi-info-circle-fill text-primary"></i>
                <h6>Informations Générales</h6>
            </div>
            <div class="detail-card-body">
                <div class="row">
                    <div class="col-md-6">
                        <span class="info-label">Produit</span>
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div style="width: 45px; height: 45px; background: #eff6ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--blue-600);">
                                <i class="bi bi-box-seam fs-4"></i>
                            </div>
                            <div>
                                <span class="fw-bold d-block text-dark fs-5">{{ $retour->produit->nom_produit ?? 'N/A' }}</span>
                                <span class="text-muted small">Code: #{{ $retour->produit_id }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span class="info-label">Commande Client</span>
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div style="width: 45px; height: 45px; background: #f8fafc; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #64748b; border: 1.5px solid #e2eaf8;">
                                <i class="bi bi-receipt fs-4"></i>
                            </div>
                            <div>
                                <span class="fw-bold d-block text-dark fs-5">Commande {{ $retour->commande_client->numero_commande ?? '#'.$retour->commande_client_id }}</span>
                                <a href="/commandes/{{ $retour->commande_client_id }}" class="text-primary small text-decoration-none fw-bold">Détails commande <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <span class="info-label">Motif du retour</span>
                        <div class="motif-box border-start border-4 border-primary">
                            {{ $retour->motif }}
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <span class="info-label">Notes Additionnelles</span>
                        <p class="text-secondary">{{ $retour->notes ?: 'Aucune note enregistrée.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="col-lg-4">
        <div class="row g-4">
            <!-- Qty Card -->
            <div class="col-12">
                <div class="detail-card">
                    <div class="detail-card-body text-center">
                        <span class="info-label mb-3">Quantité Retournée</span>
                        <div class="badge-qty mb-2">
                            {{ $retour->quantite }}
                        </div>
                        <div class="text-muted small fw-bold">Unités</div>
                        
                        <div class="mt-4 pt-3 border-top">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small fw-bold">DATE:</span>
                                <span class="fw-bold text-dark">{{ \Carbon\Carbon::parse($retour->date_retour)->format('d/m/Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted small fw-bold">RÉGION:</span>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle">{{ $retour->region->nom ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Responsible Card -->
            <div class="col-12">
                <div class="detail-card">
                    <div class="detail-card-header">
                        <i class="bi bi-person-badge-fill text-primary"></i>
                        <h6>Responsable</h6>
                    </div>
                    <div class="detail-card-body">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--blue-500), var(--blue-700)); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff;">
                                <i class="bi bi-person-fill fs-3"></i>
                            </div>
                            <div>
                                <span class="fw-bold d-block text-dark">{{ $retour->comptable->nom_complet ?? 'N/A' }}</span>
                                <span class="text-muted small">{{ $retour->comptable->poste ?? 'Comptable' }}</span>
                            </div>
                        </div>
                        <div class="ps-1">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="bi bi-telephone text-muted small"></i>
                                <span class="small fw-bold text-dark">{{ $retour->comptable->telephone ?? 'N/A' }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-envelope text-muted small"></i>
                                <span class="small fw-bold text-dark">{{ $retour->comptable->email ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Danger Zone -->
    <div class="col-12 mt-2">
        <div class="detail-card border-danger border-opacity-25" style="background: #fff5f5;">
            <div class="detail-card-body d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 40px; height: 40px; background: #fee2e2; color: #ef4444; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold text-dark">Zone de danger</h6>
                        <p class="mb-0 text-muted small">La suppression est irréversible et retirera ce retour des archives.</p>
                    </div>
                </div>
                <form action="{{ route('retours.destroy', $retour->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer définitivement ce retour ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger fw-bold px-4">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-primary-subtle { background-color: #eff6ff !important; }
    .border-primary-subtle { border-color: #bfdbfe !important; }
</style>
@endsection
