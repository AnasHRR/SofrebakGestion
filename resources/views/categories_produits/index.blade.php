@extends('_layout')
@section('title', 'Catégories Produits')
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
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 1.2rem;
    }

    /* ── Single Card ── */
    .cat-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        transition: box-shadow 0.25s ease, transform 0.25s ease;
        display: flex;
        flex-direction: column;
    }

    .cat-card:hover {
        box-shadow: 0 8px 28px rgba(29,78,216,0.12);
        transform: translateY(-2px);
    }

    /* Card top stripe */
    .cat-card-header {
        background: linear-gradient(135deg, var(--blue-700), var(--blue-900));
        padding: 1.1rem 1.3rem;
        display: flex;
        align-items: center;
        gap: 0.9rem;
        position: relative;
        overflow: hidden;
    }

    .cat-card-header::after {
        content: '';
        position: absolute;
        top: -20px; right: -20px;
        width: 90px; height: 90px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }

    .cat-avatar {
        width: 48px; height: 48px;
        background: rgba(255,255,255,0.15);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 2px solid rgba(255,255,255,0.2);
    }

    .cat-avatar i { color: #fff; font-size: 1.35rem; }

    .cat-header-info { flex: 1; min-width: 0; }

    .cat-name {
        font-size: 1rem;
        font-weight: 800;
        color: #fff;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.2;
    }

    .cat-id-badge {
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
    .cat-card-body {
        padding: 1.1rem 1.3rem;
        flex: 1;
    }

    .cat-field {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.55rem 0;
    }

    .cat-field-icon {
        width: 30px; height: 30px;
        background: #eff6ff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .cat-field-icon i { color: var(--blue-600); font-size: 0.85rem; }

    .cat-field-content { flex: 1; min-width: 0; }

    .cat-field-label {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #94a3b8;
        line-height: 1;
        margin-bottom: 2px;
    }

    .cat-field-value {
        font-size: 0.86rem;
        font-weight: 600;
        color: #1e293b;
        word-break: break-word;
    }

    /* Card footer actions */
    .cat-card-footer {
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

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #94a3b8;
    }

    .empty-state i { font-size: 3.5rem; color: #cbd5e1; margin-bottom: 1rem; display: block; }
    .empty-state h4 { font-size: 1.1rem; font-weight: 700; color: #475569; margin-bottom: 0.4rem; }
    .empty-state p { font-size: 0.85rem; }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-tags me-2" style="color:var(--blue-500);"></i>Catégories Produits</h2>
        <p>Gestion de toutes les catégories de produits</p>
    </div>
    
    <div style="display: flex; gap: 1rem; align-items: center;">
        <form action="{{ route('categories.index') }}" method="GET" style="display: flex; gap: 0.5rem; margin: 0;">
            <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}" style="padding: 0.55rem 1rem; border: 1.5px solid #e2eaf8; border-radius: 10px; font-size: 0.88rem; outline: none; width: 250px; background: #fff; color: #1e293b;">
            <button type="submit" class="btn-add" style="padding: 0.55rem 0.8rem; margin: 0; border: none; box-shadow: none;">
                <i class="bi bi-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('categories.index') }}" class="btn-add" style="padding: 0.55rem 0.8rem; background: #fff5f5; color: #ef4444; border: 1px solid #fecaca; box-shadow: none; margin: 0;">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </form>
        <a href="{{ route('categories.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Nouvelle Catégorie
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
        <div class="stat-chip-icon blue"><i class="bi bi-tags"></i></div>
        <div>
            <div class="stat-chip-value">{{ count($categories) }}</div>
            <div class="stat-chip-label">Catégories au total</div>
        </div>
    </div>
</div>

<!-- Cards Grid -->
@if(count($categories) == 0)
    <div class="empty-state">
        <i class="bi bi-inbox"></i>
        <h4>Aucune catégorie trouvée</h4>
        <p>Commencez par ajouter votre première catégorie de produits.</p>
    </div>
@else
    <div class="categories-grid">
        @foreach ($categories as $cat)
        <div class="cat-card">

            <!-- Header -->
            <div class="cat-card-header">
                <div class="cat-avatar">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="cat-header-info">
                    <div class="cat-name">{{ $cat->nom }}</div>
                    <span class="cat-id-badge">
                        <i class="bi bi-hash"></i> {{ $cat->id }}
                    </span>
                </div>
            </div>

            <!-- Body -->
            <div class="cat-card-body">
                <!-- Description -->
                <div class="cat-field">
                    <div class="cat-field-icon"><i class="bi bi-card-text"></i></div>
                    <div class="cat-field-content">
                        <div class="cat-field-label">Description</div>
                        <div class="cat-field-value">{{ $cat->description ?? '—' }}</div>
                    </div>
                </div>
            </div>

            <!-- Card Footer: Actions -->
            <div class="cat-card-footer">
                <a href="{{ route('categories.edit', $cat->id) }}" class="btn-edit">
                    <i class="bi bi-pencil-fill"></i> Modifier
                </a>
                <form action="{{ route('categories.destroy', $cat->id) }}" method="POST"
                      onsubmit="return confirm('Souhaitez-vous vraiment supprimer cette catégorie ?');" style="flex:1;display:flex;">
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