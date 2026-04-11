@extends('_layout')
@section('title', 'Commandes Fournisseurs')
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

    .badge-statut {
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
        font-size: 0.78rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .badge-statut.attente { background: #fef08a; color: #854d0e; border: 1px solid #fde047; }
    .badge-statut.livree { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .badge-statut.annulee { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-cart me-2" style="color:var(--blue-500);"></i>Commandes Fournisseurs</h2>
        <p>Gestion des commandes auprès de vos fournisseurs</p>
    </div>
    
    <div>
        <a href="{{ route('commandesFournisseurs.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Nouvelle Commande
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert-success">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
@endif

<!-- Table Card -->
<div class="table-card">
    <div style="overflow-x: auto;">
        <table class="custom-table">
            <thead>
                <tr>
                    <th><i class="bi bi-hash me-1"></i> ID</th>
                    <th><i class="bi bi-calendar me-1"></i> Date</th>
                    <th><i class="bi bi-truck me-1"></i> Fournisseur</th>
                    <th><i class="bi bi-person me-1"></i> Employé (Responsable)</th>
                    <th><i class="bi bi-currency-dollar me-1"></i> Montant</th>
                    <th><i class="bi bi-info-circle me-1"></i> Statut</th>
                    <th style="width: 140px; text-align: center;"><i class="bi bi-gear me-1"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($commandes as $commande)
                    <tr>
                        <td style="font-weight: 700; color: #64748b;">#{{ $commande->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}</td>
                        <td style="font-weight: 700;">
                            {{ $commande->fournisseur ? $commande->fournisseur->nom : 'N/A' }}
                        </td>
                        <td>
                            {{ $commande->employe ? $commande->employe->nom_complet : 'N/A' }}
                        </td>
                        <td style="font-weight: 800; font-size: 1.05rem; color: #0f1e4a;">
                            {{ number_format($commande->montant_total, 2, ',', ' ') }} DH
                        </td>
                        <td>
                            @php
                                $statusClass = 'attente';
                                $icon = 'bi-clock';
                                if(strtolower($commande->statut) == 'livrée' || strtolower($commande->statut) == 'livree') {
                                    $statusClass = 'livree';
                                    $icon = 'bi-check-circle';
                                } elseif(strtolower($commande->statut) == 'annulée' || strtolower($commande->statut) == 'annulee') {
                                    $statusClass = 'annulee';
                                    $icon = 'bi-x-circle';
                                }
                            @endphp
                            <span class="badge-statut {{ $statusClass }}">
                                <i class="bi {{ $icon }}"></i> {{ ucfirst($commande->statut) }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons justify-content-center">
                                <a href="{{ route('commandesFournisseurs.show', $commande->id) }}" class="btn-icon btn-icon-view" title="Afficher">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('commandesFournisseurs.edit', $commande->id) }}" class="btn-icon btn-icon-edit" title="Modifier">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('commandesFournisseurs.destroy', $commande->id) }}" method="POST" onsubmit="return confirm('Confirmez-vous la suppression de cette commande ?');" style="margin:0;">
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
                        <td colspan="7" style="text-align: center; padding: 4rem 2rem; color: #94a3b8;">
                            <i class="bi bi-inbox" style="font-size: 3.5rem; color: #cbd5e1; margin-bottom: 1rem; display: block;"></i>
                            <h4 style="font-size: 1.1rem; font-weight: 700; color: #475569; margin-bottom: 0.4rem;">Aucune commande trouvée</h4>
                            <p style="font-size: 0.85rem;">Commencez par créer votre première commande fournisseur.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
