@extends('_layout')

@section('title', 'Détails du Paiement - Sofrebak')

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

    .notes-box {
        background: #f8fafc;
        border: 1.5px solid #e2eaf8;
        border-radius: 12px;
        padding: 1rem;
        color: #475569;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .badge-montant {
        background: linear-gradient(135deg, #059669, #047857);
        color: #fff;
        padding: 0.6rem 1.2rem;
        border-radius: 12px;
        font-size: 1.4rem;
        font-weight: 800;
        display: inline-block;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
    }

    .badge-mode-show {
        font-size: 0.82rem;
        font-weight: 700;
        padding: 0.35rem 0.8rem;
        border-radius: 8px;
        display: inline-block;
    }

    .badge-especes { background: #fef3c7; color: #92400e; }
    .badge-cheque { background: #e0e7ff; color: #3730a3; }
    .badge-virement { background: #d1fae5; color: #065f46; }
    .badge-carte { background: #fce7f3; color: #9d174d; }
    .badge-default { background: #f1f5f9; color: #475569; }
</style>

<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-eye-fill me-2" style="color:var(--blue-500);"></i>Détails Paiement #{{ $paiement->id }}</h2>
        <p>Consultation des informations du paiement</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('paiements.index') }}" class="btn-action">
            <i class="bi bi-arrow-left me-1"></i> Retour à la liste
        </a>
        <a href="{{ route('paiements.edit', $paiement->id) }}" class="btn-action btn-edit-main">
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
                        <span class="info-label">Client</span>
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div style="width: 45px; height: 45px; background: #eff6ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--blue-600);">
                                <i class="bi bi-building fs-4"></i>
                            </div>
                            <div>
                                <span class="fw-bold d-block text-dark fs-5">{{ $paiement->client->nom_entreprise ?? 'N/A' }}</span>
                                <span class="text-muted small">ID Client: #{{ $paiement->client_id }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span class="info-label">Date de Paiement</span>
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div style="width: 45px; height: 45px; background: #f8fafc; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #64748b; border: 1.5px solid #e2eaf8;">
                                <i class="bi bi-calendar-check fs-4"></i>
                            </div>
                            <div>
                                <span class="fw-bold d-block text-dark fs-5">{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</span>
                                <span class="text-muted small">{{ \Carbon\Carbon::parse($paiement->date_paiement)->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <span class="info-label">Mode de Paiement</span>
                        @php
                            $modeClass = match(strtolower($paiement->mode_paiement)) {
                                'espèces', 'especes' => 'badge-especes',
                                'chèque', 'cheque' => 'badge-cheque',
                                'virement' => 'badge-virement',
                                'carte bancaire', 'carte' => 'badge-carte',
                                default => 'badge-default',
                            };
                        @endphp
                        <div class="mb-4">
                            <span class="badge-mode-show {{ $modeClass }}">
                                <i class="bi bi-credit-card me-1"></i>{{ $paiement->mode_paiement }}
                            </span>
                            @if($paiement->numero_cheque)
                                <div class="mt-2">
                                    <span class="info-label">N° de Chèque</span>
                                    <span class="fw-bold text-dark"><i class="bi bi-hash me-1"></i>{{ $paiement->numero_cheque }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <span class="info-label">Région</span>
                        <div class="mb-4">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 fw-bold">
                                <i class="bi bi-geo-alt me-1"></i>{{ $paiement->region->nom ?? 'N/A' }}
                            </span>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <span class="info-label">Notes</span>
                        <div class="notes-box border-start border-4 border-primary">
                            {{ $paiement->notes ?: 'Aucune note enregistrée.' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="col-lg-4">
        <div class="row g-4">
            <!-- Amount Card -->
            <div class="col-12">
                <div class="detail-card">
                    <div class="detail-card-body text-center">
                        <span class="info-label mb-3">Montant du Paiement</span>
                        <div class="badge-montant mb-2">
                            {{ number_format($paiement->montant, 2, ',', ' ') }} DH
                        </div>
                        <div class="text-muted small fw-bold mt-2">Dirhams Marocains</div>
                        
                        <div class="mt-4 pt-3 border-top">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small fw-bold">DATE:</span>
                                <span class="fw-bold text-dark">{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted small fw-bold">RÉGION:</span>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle">{{ $paiement->region->nom ?? 'N/A' }}</span>
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
                                <span class="fw-bold d-block text-dark">{{ $paiement->comptable->nom_complet ?? 'N/A' }}</span>
                                <span class="text-muted small">{{ $paiement->comptable->poste ?? 'Comptable' }}</span>
                            </div>
                        </div>
                        <div class="ps-1">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="bi bi-telephone text-muted small"></i>
                                <span class="small fw-bold text-dark">{{ $paiement->comptable->telephone ?? 'N/A' }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-envelope text-muted small"></i>
                                <span class="small fw-bold text-dark">{{ $paiement->comptable->email ?? 'N/A' }}</span>
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
                        <p class="mb-0 text-muted small">La suppression est irréversible et retirera ce paiement des archives.</p>
                    </div>
                </div>
                <form action="{{ route('paiements.destroy', $paiement->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer définitivement ce paiement ?');">
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
