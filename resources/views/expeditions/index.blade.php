@extends('_layout')

@section('title', 'Expéditions')

@section('content')
<style>
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
        padding: 1rem 1rem;
        border-bottom: 2px solid #e2eaf8;
        text-align: left;
        white-space: nowrap;
    }

    .custom-table tbody td {
        padding: 0.85rem 1rem;
        border-bottom: 1px solid #f1f5fb;
        color: #1e293b;
        font-size: 0.86rem;
        font-weight: 500;
        vertical-align: middle;
    }
    
    .badge-statut {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.3rem 0.7rem;
        border-radius: 20px;
        font-size: 0.74rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .badge-statut.livre { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .badge-statut.default { background: #eff6ff; color: var(--blue-600); border: 1px solid #bfdbfe; }

    .action-buttons {
        display: flex;
        gap: 0.4rem;
        justify-content: center;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
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

    .btn-icon-view   { background: #f0fdf4; color: #16a34a; border: 1.5px solid #bbf7d0; }
    .btn-icon-edit   { background: #eff6ff; color: var(--blue-600); border: 1.5px solid #bfdbfe; }
    .btn-icon-delete { background: #fff5f5; color: #ef4444; border: 1.5px solid #fecaca; }
    
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

<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-truck me-2" style="color:var(--blue-500);"></i>Expéditions</h2>
        <p>Gérez vos expéditions et suivez les livraisons</p>
    </div>
    <a href="{{ route('expeditions.create') }}" class="btn-add">
        <i class="bi bi-plus-lg"></i> Nouvelle Expédition
    </a>
</div>

@if (session('success'))
    <div class="alert-success">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
@endif

<div class="table-card">
    <div style="overflow-x: auto;">
        <table class="custom-table">
            <thead>
                <tr>
                    <th><i class="bi bi-hash me-1"></i> ID</th>
                    <th><i class="bi bi-person me-1"></i> Chauffeur</th>
                    <th><i class="bi bi-calendar3 me-1"></i> Date Expédition</th>
                    <th><i class="bi bi-truck me-1"></i> Camion</th>
                    <th style="text-align:center;"><i class="bi bi-flag me-1"></i> Statut</th>
                    <th style="width:180px;text-align:center;"><i class="bi bi-gear me-1"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($expeditions as $exped)
                    <tr>
                        <td><strong>#{{ $exped->id }}</strong></td>
                        <td>{{ $exped->employes->nom_complet ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($exped->date_expedition)->format('d/m/Y') }}</td>
                        <td>{{ $exped->numero_camion }}</td>
                        <td style="text-align:center;">
                            @if($exped->statut_livraison == 'Livré')
                                <span class="badge-statut livre">{{ $exped->statut_livraison }}</span>
                            @else
                                <span class="badge-statut default">{{ $exped->statut_livraison }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('expeditions.edit', $exped->id) }}" class="btn-icon btn-icon-edit" title="Modifier">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                @if($exped->statut_livraison != 'Livré')
                                <form action="{{ route('expeditions.valider', $exped->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment valider cette expédition comme livrée ?');">
                                    @csrf
                                    <button type="submit" class="btn-icon btn-icon-view" title="Valider Livraison">
                                        <i class="bi bi-check2-circle"></i>
                                    </button>
                                </form>
                                @endif
                                <form action="{{ route('expeditions.destroy', $exped->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Confirmer la suppression ?');">
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
                        <td colspan="7" style="text-align:center; padding: 3rem;">
                            <div style="color: #94a3b8;"><i class="bi bi-emoji-frown" style="font-size: 2rem;"></i><br>Aucune expédition trouvée.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection