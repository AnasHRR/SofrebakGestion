@extends('_layout')
@section('title', 'Produits')
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
        min-width: 150px;
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

    .stat-chip-icon.dark { background: #334155; color: #fff; }
    .stat-chip-icon.blue { background: #eff6ff; color: var(--blue-600); }
    .stat-chip-icon.red { background: #fef2f2; color: #ef4444; }
    .stat-chip-icon.indigo { background: #eef2ff; color: #4f46e5; }

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
        padding: 1rem 1.2rem;
        border-bottom: 2px solid #e2eaf8;
        text-align: left;
    }

    .custom-table tbody td {
        padding: 1rem 1.2rem;
        border-bottom: 1px solid #e2eaf8;
        color: #1e293b;
        font-size: 0.88rem;
        font-weight: 500;
        vertical-align: middle;
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    .custom-table tbody tr:hover {
        background: #f8faff;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-icon {
        width: 32px; height: 32px;
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

    .btn-icon-view { background: #f0fdf4; color: #16a34a; border: 1.5px solid #bbf7d0; }
    .btn-icon-view:hover { background: #16a34a; color: #fff; border-color: #16a34a; }

    .btn-icon-edit { background: #eff6ff; color: var(--blue-600); border: 1.5px solid #bfdbfe; }
    .btn-icon-edit:hover { background: var(--blue-600); color: #fff; border-color: var(--blue-600); }

    .btn-icon-delete { background: #fff5f5; color: #ef4444; border: 1.5px solid #fecaca; }
    .btn-icon-delete:hover { background: #ef4444; color: #fff; border-color: #ef4444; }

    /* Flash alerts */
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
    
    .alert-danger {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        border-radius: 12px;
        padding: 0.85rem 1.2rem;
        margin-bottom: 1.5rem;
        font-size: 0.88rem;
        font-weight: 600;
    }

    .badge-stock {
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
        font-size: 0.78rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .badge-stock.success { background: #eff6ff; color: var(--blue-600); border: 1px solid #bfdbfe; }
    .badge-stock.warning { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
    .badge-stock.danger { background: #fff5f5; color: #ef4444; border: 1px solid #fecaca; }

    .pagination-wrapper {
        padding: 1rem 1.2rem;
        background: #fafbff;
        border-top: 1px solid #e2eaf8;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-box-seam-fill me-2" style="color:var(--blue-500);"></i>Produits</h2>
        <p>Gestion complète de votre inventaire de produits</p>
    </div>
    
    <div style="display: flex; gap: 1rem; align-items: center;">
        <form action="{{ route('produits.index') }}" method="GET" style="display: flex; gap: 0.5rem; margin: 0;">
            <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}" style="padding: 0.55rem 1rem; border: 1.5px solid #e2eaf8; border-radius: 10px; font-size: 0.88rem; outline: none; width: 250px; background: #fff; color: #1e293b;">
            <button type="submit" class="btn-add" style="padding: 0.55rem 0.8rem; margin: 0; border: none; box-shadow: none;">
                <i class="bi bi-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('produits.index') }}" class="btn-add" style="padding: 0.55rem 0.8rem; background: #fff5f5; color: #ef4444; border: 1px solid #fecaca; box-shadow: none; margin: 0;">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </form>
        <a href="{{ route('produits.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Nouveau Produit
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert-success">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
@elseif (session('alert'))
    <div class="alert-danger">
        <i class="bi bi-exclamation-circle-fill"></i>
        {{ session('alert') }}
    </div>
@endif

<!-- Stats -->
<div class="stats-bar">
    <div class="stat-chip">
        <div class="stat-chip-icon dark"><i class="bi bi-boxes"></i></div>
        <div>
            <div class="stat-chip-value">{{ $totalProduits }}</div>
            <div class="stat-chip-label">Total Produits</div>
        </div>
    </div>
    <div class="stat-chip">
        <div class="stat-chip-icon blue"><i class="bi bi-check-lg"></i></div>
        <div>
            <div class="stat-chip-value">{{ $totalEnStock }}</div>
            <div class="stat-chip-label">En Stock</div>
        </div>
    </div>
    <div class="stat-chip">
        <div class="stat-chip-icon red"><i class="bi bi-exclamation-triangle"></i></div>
        <div>
            <div class="stat-chip-value">{{ $totalRupture }}</div>
            <div class="stat-chip-label">Rupture</div>
        </div>
    </div>
    <div class="stat-chip">
        <div class="stat-chip-icon indigo"><i class="bi bi-cash-stack"></i></div>
        <div>
            <div class="stat-chip-value">{{ number_format($valeurTotaleStock, 2, ',', ' ') }} DH</div>
            <div class="stat-chip-label">Valeur Stock</div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="table-card">
    <div style="overflow-x: auto;">
        <table class="custom-table">
            <thead>
                <tr>
                    <th><i class="bi bi-box me-1"></i> Produit</th>
                    <th><i class="bi bi-rulers me-1"></i> Unité</th>
                    <th><i class="bi bi-tag me-1"></i> Prix d'achat</th>
                    <th><i class="bi bi-tag-fill me-1"></i> Prix de vente</th>
                    <th><i class="bi bi-layers me-1"></i> Stock</th>
                    <th style="width: 140px; text-align: center;"><i class="bi bi-gear me-1"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produits as $pr)
                    <tr>
                        <td style="font-weight: 700;">
                            <div style="display: flex; align-items: center; gap: 0.8rem;">
                                <div style="width: 38px; height: 38px; background: #eff6ff; display: flex; align-items: center; justify-content: center; border-radius: 10px; flex-shrink: 0; overflow: hidden;">
                                    @if($pr->img_pr)
                                        <img src="{{ asset($pr->img_pr) }}" alt="{{ $pr->nom_produit }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <i class="bi bi-box-seam" style="color: var(--blue-600); font-size: 1.1rem;"></i>
                                    @endif
                                </div>
                                {{ $pr->nom_produit }}
                            </div>
                        </td>
                        <td>
                            <span style="background: #f1f5fb; border: 1px solid #e2eaf8; padding: 0.3rem 0.6rem; border-radius: 7px; font-weight: 600; font-size: 0.78rem;">
                                {{ $pr->unite }}
                            </span>
                        </td>
                        <td>
                            <strong>{{ number_format($pr->prix_achat, 2, ',', ' ') }}</strong> <span style="font-size: 0.7rem; color: #64748b;">DH</span>
                        </td>
                        <td>
                            <strong>{{ number_format($pr->prix_vente, 2, ',', ' ') }}</strong> <span style="font-size: 0.7rem; color: #64748b;">DH</span>
                        </td>
                        <td>
                            @if($pr->stock_actuel <= 0)
                                <span class="badge-stock danger">
                                    <i class="bi bi-x-circle-fill"></i> {{ $pr->stock_actuel }}
                                </span>
                            @elseif($pr->stock_actuel <= 10)
                                <span class="badge-stock warning">
                                    <i class="bi bi-exclamation-triangle-fill"></i> {{ $pr->stock_actuel }}
                                </span>
                            @else
                                <span class="badge-stock success">
                                    <i class="bi bi-check-circle-fill"></i> {{ $pr->stock_actuel }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons justify-content-center">
                                <a href="{{ route('produits.show', $pr->id) }}" class="btn-icon btn-icon-view" title="Détails">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('produits.edit', $pr->id) }}" class="btn-icon btn-icon-edit" title="Modifier">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('produits.destroy', $pr->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');" style="margin:0;">
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
                        <td colspan="6" style="text-align: center; padding: 4rem 2rem; color: #94a3b8;">
                            <i class="bi bi-inbox" style="font-size: 3.5rem; color: #cbd5e1; margin-bottom: 1rem; display: block;"></i>
                            <h4 style="font-size: 1.1rem; font-weight: 700; color: #475569; margin-bottom: 0.4rem;">Aucun produit trouvé</h4>
                            <p style="font-size: 0.85rem;">Commencez par ajouter votre premier produit.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(count($produits) > 0)
    <div class="pagination-wrapper">
        <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Affichage des produits</span>
        <div>
            {{ $produits->links() }}
        </div>
    </div>
    @endif
</div>

@endsection