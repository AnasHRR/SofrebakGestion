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
            box-shadow: 0 4px 14px rgba(29, 78, 216, 0.35);
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .table-card {
            background: #ffffff;
            border: 1px solid #e2eaf8;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(15, 42, 110, 0.06);
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

        .badge-statut.livre {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        .badge-statut.default {
            background: #eff6ff;
            color: var(--blue-600);
            border: 1px solid #bfdbfe;
        }

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

        .btn-icon-view {
            background: #f0fdf4;
            color: #16a34a;
            border: 1.5px solid #bbf7d0;
        }

        .btn-icon-edit {
            background: #eff6ff;
            color: var(--blue-600);
            border: 1.5px solid #bfdbfe;
        }

        .btn-icon-delete {
            background: #fff5f5;
            color: #ef4444;
            border: 1.5px solid #fecaca;
        }

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

        /* ── Status Filter Select ── */
        .filter-select-wrapper {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        .filter-select-icon {
            position: absolute;
            left: 0.75rem;
            color: var(--blue-500);
            font-size: 0.85rem;
            pointer-events: none;
            z-index: 1;
        }

        .filter-select {
            appearance: none;
            -webkit-appearance: none;
            padding: 0.55rem 2.4rem 0.55rem 2.1rem;
            border: 1.5px solid #e2eaf8;
            border-radius: 10px;
            font-size: 0.845rem;
            font-weight: 600;
            outline: none;
            background: #fff;
            color: #1e293b;
            cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            min-width: 175px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.7rem center;
        }

        .filter-select:hover {
            border-color: var(--blue-400, #60a5fa);
            background-color: #f8fbff;
        }

        .filter-select:focus {
            border-color: var(--blue-500);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            background-color: #fff;
        }

        /* Active filter pill (when a status is selected) */
        .filter-select.is-active {
            border-color: var(--blue-500);
            background-color: #eff6ff;
            color: var(--blue-700, #1d4ed8);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        }
    </style>

    <div class="page-header">
        <div class="page-header-left">
            <h2><i class="bi bi-truck me-2" style="color:var(--blue-500);"></i>Expéditions</h2>
            <p>Gérez vos expéditions et suivez les livraisons</p>
        </div>
        <div style="display: flex; gap: 1rem; align-items: center;">
            <form action="{{ route('expeditions.index') }}" method="GET" style="display: flex; gap: 0.5rem; margin: 0;">
                <input type="text" name="search" placeholder="Rechercher une commande, camion..." value="{{ $search ?? '' }}" style="padding: 0.55rem 1rem; border: 1.5px solid #e2eaf8; border-radius: 10px; font-size: 0.88rem; outline: none; width: 280px; background: #fff; color: #1e293b;">
<div class="filter-select-wrapper">
                    <i class="bi bi-funnel-fill filter-select-icon"></i>
                    <select
                        name="statut"
                        id="statut-filter"
                        class="filter-select {{ (isset($statut) && $statut) ? 'is-active' : '' }}"
                        onchange="this.form.submit()"
                    >
                        <option value="">Tous les statuts</option>
                        <option value="Livrée"  {{ (isset($statut) && $statut == 'Livrée')     ? 'selected' : '' }}>Livrée</option>
                        <option value="Non Livrée" {{ (isset($statut) && $statut == 'Non Livrée') ? 'selected' : '' }}>Non Livrée</option>
                    </select>
                </div>
                <button type="submit" class="btn-add" style="padding: 0.55rem 0.8rem; margin: 0; border: none; box-shadow: none;">
                    <i class="bi bi-search"></i>
                </button>
                @if((isset($search) && $search) || (isset($statut) && $statut))
                    <a href="{{ route('expeditions.index') }}" class="btn-add" style="padding: 0.55rem 0.8rem; background: #fff5f5; color: #ef4444; border: 1px solid #fecaca; box-shadow: none; margin: 0;">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </form>
            <a href="{{ route('expeditions.create') }}" class="btn-add">
                <i class="bi bi-plus-lg"></i> Nouvelle Expédition
            </a>
        </div>
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
                        {{-- <th><i class="bi bi-hash me-1"></i> ID</th> --}}
                        <th><i class="bi bi-person me-1"></i> Chauffeur</th>
                        <th><i class="bi bi-calendar3 me-1"></i> Date Expédition</th>
                        <th><i class="bi bi-truck me-1"></i> Camion</th>
                        <th><i class="bi bi-bag-check me-1"></i> Commandes</th>
                        <th style="text-align:center;"><i class="bi bi-flag me-1"></i> Statut</th>
                        <th style="width:180px;text-align:center;"><i class="bi bi-gear me-1"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expeditions as $exped)
                        <tr>
                            {{-- <td><strong>#{{ $exped->id }}</strong></td> --}}
                            <td>{{ $exped->employes->nom_complet ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($exped->date_expedition)->format('d/m/Y') }}</td>
                            <td>{{ $exped->numero_camion }}</td>
                            <td>
                                @if($exped->commandesClients->count() > 0)
                                    <div style="display:flex; flex-wrap:wrap; gap:4px;">
                                        @foreach($exped->commandesClients->take(3) as $cmd)
                                            <span style="font-size:0.7rem; background:#f1f5f9; color:#475569; padding:2px 6px; border-radius:4px; border:1px solid #e2e8f0;">
                                                {{ $cmd->numero_commande ?: '#'.$cmd->id }}
                                            </span>
                                        @endforeach
                                        @if($exped->commandesClients->count() > 3)
                                            <span style="font-size:0.7rem; color:#94a3b8; padding:2px 6px;">+{{ $exped->commandesClients->count() - 3 }} autres</span>
                                        @endif
                                    </div>
                                @else
                                    <span style="color:#cbd5e1; font-size:0.8rem;">Aucune</span>
                                @endif
                            </td>
                            <td style="text-align:center;">
                                @if($exped->statut_livraison == 'Livré' || $exped->statut_livraison == 'Livrée')
                                    <span class="badge-statut livre"
                                        style="background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0;">{{ $exped->statut_livraison }}</span>
                                @else
                                    <span class="badge-statut default">{{ $exped->statut_livraison }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('expeditions.show', $exped->id) }}" class="btn-icon" title="Détails"
                                        style="background: #f0fdf4; color: #16a34a; border: 1.5px solid #bbf7d0;">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>

                                    @if($exped->statut_livraison !== 'Livrée' && $exped->statut_livraison !== 'Livré')
                                        <a href="{{ route('expeditions.edit', $exped->id) }}" class="btn-icon btn-icon-edit"
                                            title="Modifier">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('expeditions.valider', $exped->id) }}" method="POST"
                                            style="display:inline; margin:0;"
                                            onsubmit="return confirm('Voulez-vous vraiment valider cette expédition comme livrée ?');">
                                            @csrf
                                            <button type="submit" class="btn-icon" title="Valider Livraison"
                                                style="background:#fff7ed; color:#ea580c; border: 1.5px solid #fed7aa;">
                                                <i class="bi bi-check2-circle"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('expeditions.destroy', $exped->id) }}" method="POST"
                                            style="display:inline; margin:0;"
                                            onsubmit="return confirm('Confirmer la suppression ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon btn-icon-delete" title="Supprimer">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; padding: 3rem;">
                                <div style="color: #94a3b8;"><i class="bi bi-emoji-frown"
                                        style="font-size: 2rem;"></i><br>Aucune expédition trouvée.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection