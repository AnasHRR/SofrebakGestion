@extends('_layout')
@section('title', 'Fournisseurs')
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
    }

    .btn-add:hover {
        box-shadow: 0 6px 20px rgba(29,78,216,0.5);
        transform: translateY(-1px);
        color: #fff;
    }

    /* ── Stats Bar ── */
    .stats-bar {
        display: flex;
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
    }

    .stat-chip-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .stat-chip-icon.blue { background: #eff6ff; color: var(--blue-600); }

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

    /* ── Cards Grid ── */
    .fournisseurs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 1.2rem;
    }

    /* ── Single Card ── */
    .fr-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        transition: box-shadow 0.25s ease, transform 0.25s ease;
    }

    .fr-card:hover {
        box-shadow: 0 8px 28px rgba(29,78,216,0.12);
        transform: translateY(-2px);
    }

    /* Card top stripe */
    .fr-card-header {
        background: linear-gradient(135deg, var(--blue-700), var(--blue-900));
        padding: 1.1rem 1.3rem;
        display: flex;
        align-items: center;
        gap: 0.9rem;
        position: relative;
        overflow: hidden;
    }

    .fr-card-header::after {
        content: '';
        position: absolute;
        top: -20px; right: -20px;
        width: 90px; height: 90px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }

    .fr-avatar {
        width: 48px; height: 48px;
        background: rgba(255,255,255,0.15);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 2px solid rgba(255,255,255,0.2);
    }

    .fr-avatar i { color: #fff; font-size: 1.35rem; }

    .fr-header-info { flex: 1; min-width: 0; }

    .fr-name {
        font-size: 1rem;
        font-weight: 800;
        color: #fff;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.2;
    }

    .fr-id-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        margin-top: 4px;
        background: rgba(255,255,255,0.15);
        border-radius: 6px;
        padding: 2px 8px;
        font-size: 0.65rem;
        color: rgba(255,255,255,0.8);
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    /* Card body */
    .fr-card-body {
        padding: 1.1rem 1.3rem;
    }

    .fr-field {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.55rem 0;
        border-bottom: 1px solid #f1f5fb;
    }

    .fr-field:last-child { border-bottom: none; }

    .fr-field-icon {
        width: 30px; height: 30px;
        background: #eff6ff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .fr-field-icon i { color: var(--blue-600); font-size: 0.85rem; }

    .fr-field-content { flex: 1; min-width: 0; }

    .fr-field-label {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #94a3b8;
        line-height: 1;
        margin-bottom: 2px;
    }

    .fr-field-value {
        font-size: 0.86rem;
        font-weight: 600;
        color: #1e293b;
        word-break: break-word;
    }

    .fr-field-value a {
        color: var(--blue-600);
        text-decoration: none;
    }

    .fr-field-value a:hover { text-decoration: underline; }

    /* Payment badge */
    .payment-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: #f0fdf4;
        color: #16a34a;
        border: 1px solid #bbf7d0;
        border-radius: 7px;
        padding: 2px 8px;
        font-size: 0.78rem;
        font-weight: 600;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #94a3b8;
    }

    .empty-state i { font-size: 3.5rem; color: #cbd5e1; margin-bottom: 1rem; display: block; }
    .empty-state h4 { font-size: 1.1rem; font-weight: 700; color: #475569; margin-bottom: 0.4rem; }
    .empty-state p { font-size: 0.85rem; }

    /* Card footer actions */
    .fr-card-footer {
        display: flex;
        gap: 0.6rem;
        padding: 0.85rem 1.3rem;
        border-top: 1px solid #f1f5fb;
        background: #fafbff;
    }

    .btn-edit, .btn-delete {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        padding: 0.45rem 0.8rem;
        border-radius: 9px;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    .btn-edit {
        background: #eff6ff;
        color: var(--blue-600);
        border: 1.5px solid #bfdbfe;
    }

    .btn-edit:hover {
        background: var(--blue-600);
        color: #fff;
        border-color: var(--blue-600);
    }

    .btn-delete {
        background: #fff5f5;
        color: #ef4444;
        border: 1.5px solid #fecaca;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: #fff;
        border-color: #ef4444;
    }

    /* Flash alert */
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
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-truck me-2" style="color:var(--blue-500);"></i>Fournisseurs</h2>
        <p>Gestion et suivi de tous vos fournisseurs</p>
    </div>
    <div style="display: flex; gap: 1rem; align-items: center;">
        <form action="{{ route('fournisseurs.index') }}" method="GET" style="display: flex; gap: 0.5rem; margin: 0;">
            <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}" style="padding: 0.55rem 1rem; border: 1.5px solid #e2eaf8; border-radius: 10px; font-size: 0.88rem; outline: none; width: 250px; background: #fff; color: #1e293b;">
            <button type="submit" class="btn-add" style="padding: 0.55rem 0.8rem; margin: 0;border:none;">
                <i class="bi bi-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('fournisseurs.index') }}" class="btn-add" style="padding: 0.55rem 0.8rem; background: #fff5f5; color: #ef4444; border: 1px solid #fecaca; box-shadow: none; margin: 0;">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </form>
        <a href="{{ route('fournisseurs.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Nouveau Fournisseur
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
        <div class="stat-chip-icon blue"><i class="bi bi-truck"></i></div>
        <div>
            <div class="stat-chip-value">{{ count($fournisseurs) }}</div>
            <div class="stat-chip-label">Fournisseurs au total</div>
        </div>
    </div>
</div>

<!-- Cards Grid -->
@if($fournisseurs->isEmpty())
    <div class="empty-state">
        <i class="bi bi-inbox"></i>
        <h4>Aucun fournisseur trouvé</h4>
        <p>Commencez par ajouter votre premier fournisseur.</p>
    </div>
@else
    <div class="fournisseurs-grid">
        @foreach ($fournisseurs as $fr)
        <div class="fr-card">

            <!-- Header -->
            <div class="fr-card-header">
                <div class="fr-avatar">
                    <i class="bi bi-building"></i>
                </div>
                <div class="fr-header-info">
                    <div class="fr-name">{{ $fr->nom }}</div>
                    <span class="fr-id-badge">
                        <i class="bi bi-hash"></i> {{ $fr->id }}
                    </span>
                </div>
            </div>

            <!-- Body -->
            <div class="fr-card-body">

                <!-- Contact Person -->
                <div class="fr-field">
                    <div class="fr-field-icon"><i class="bi bi-person-fill"></i></div>
                    <div class="fr-field-content">
                        <div class="fr-field-label">Personne de contact</div>
                        <div class="fr-field-value">{{ $fr->personne_contact ?? '—' }}</div>
                    </div>
                </div>

                <!-- Phone -->
                <div class="fr-field">
                    <div class="fr-field-icon"><i class="bi bi-telephone-fill"></i></div>
                    <div class="fr-field-content">
                        <div class="fr-field-label">Téléphone</div>
                        <div class="fr-field-value">
                            <a href="tel:{{ $fr->telephone }}">{{ $fr->telephone ?? '—' }}</a>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="fr-field">
                    <div class="fr-field-icon"><i class="bi bi-envelope-fill"></i></div>
                    <div class="fr-field-content">
                        <div class="fr-field-label">Email</div>
                        <div class="fr-field-value">
                            <a href="mailto:{{ $fr->email }}">{{ $fr->email ?? '—' }}</a>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="fr-field">
                    <div class="fr-field-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    <div class="fr-field-content">
                        <div class="fr-field-label">Adresse</div>
                        <div class="fr-field-value">{{ $fr->adresse ?? '—' }}</div>
                    </div>
                </div>

                <!-- Payment Terms -->
                <div class="fr-field">
                    <div class="fr-field-icon"><i class="bi bi-credit-card-fill"></i></div>
                    <div class="fr-field-content">
                        <div class="fr-field-label">Conditions de paiement</div>
                        <div class="fr-field-value">
                            @if($fr->conditions_paiement)
                                <span class="payment-badge">
                                    <i class="bi bi-check-circle-fill" style="font-size:0.7rem;"></i>
                                    {{ $fr->conditions_paiement }}
                                </span>
                            @else
                                —
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <!-- Card Footer: Actions -->
            <div class="fr-card-footer">
                <a href="{{ route('fournisseurs.edit', $fr->id) }}" class="btn-edit">
                    <i class="bi bi-pencil-fill"></i> Modifier
                </a>
                <form action="{{ route('fournisseurs.destroy', $fr->id) }}" method="POST"
                      onsubmit="return confirm('Supprimer ce fournisseur ?');" style="flex:1;display:flex;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">
                        <i class="bi bi-trash-fill"></i> Supprimer
                    </button>
                </form>
            </div>

        </div>
        @endforeach
    </div>
@endif

@endsection