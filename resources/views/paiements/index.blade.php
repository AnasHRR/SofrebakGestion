@extends('_layout')
@section('title', 'Paiements')
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
            box-shadow: 0 4px 14px rgba(29, 78, 216, 0.35);
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-add:hover {
            box-shadow: 0 6px 20px rgba(29, 78, 216, 0.5);
            transform: translateY(-1px);
            color: #fff;
        }

        /* ── Table Container ── */
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

        .custom-table tbody tr:hover {
            background: #f8faff;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
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

        .btn-icon-view:hover {
            background: #16a34a;
            color: #fff;
            border-color: #16a34a;
        }

        .btn-icon-edit {
            background: #eff6ff;
            color: var(--blue-600);
            border: 1.5px solid #bfdbfe;
        }

        .btn-icon-edit:hover {
            background: var(--blue-600);
            color: #fff;
            border-color: var(--blue-600);
        }

        .btn-icon-delete {
            background: #fff5f5;
            color: #ef4444;
            border: 1.5px solid #fecaca;
        }

        .btn-icon-delete:hover {
            background: #ef4444;
            color: #fff;
            border-color: #ef4444;
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

        .badge-mode {
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            display: inline-block;
        }

        .badge-especes { background: #fef3c7; color: #92400e; }
        .badge-cheque { background: #e0e7ff; color: #3730a3; }
        .badge-virement { background: #d1fae5; color: #065f46; }
        .badge-carte { background: #fce7f3; color: #9d174d; }
        .badge-default { background: #f1f5f9; color: #475569; }

        .montant-cell {
            font-weight: 800;
            color: #0f1e4a;
            font-size: 0.92rem;
        }
    </style>

    <div class="page-header">
        <div class="page-header-left">
            <h2><i class="bi bi-cash-stack me-2" style="color:var(--blue-500);"></i>Paiements</h2>
            <p>Gestion des paiements clients</p>
        </div>

        <a href="{{ route('paiements.create') }}" class="btn-add">
            <i class="bi bi-plus-lg"></i> Nouveau Paiement
        </a>
    </div>

    @if (session('success'))
        <div class="alert-success">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-success" style="background: #fef2f2; border-color: #fecaca; color: #b91c1c;">
            <i class="bi bi-exclamation-octagon-fill"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="table-card">
        <div style="overflow-x: auto;">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th><i class="bi bi-person me-1"></i> Client</th>
                        <th><i class="bi bi-currency-dollar me-1"></i> Montant</th>
                        <th><i class="bi bi-calendar-date me-1"></i> Date</th>
                        <th><i class="bi bi-credit-card me-1"></i> Mode</th>
                        <th><i class="bi bi-flag me-1"></i> Statut</th>
                        <th><i class="bi bi-person-badge me-1"></i> Comptable</th>
                        <th><i class="bi bi-geo-alt me-1"></i> Région</th>
                        <th style="width: 130px; text-align: center;"><i class="bi bi-gear me-1"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($paiements as $paiement)
                        <tr>
                            <td style="font-weight: 700;">{{ $paiement->client->nom_entreprise ?? $paiement->client_id }}</td>
                            <td>
                                <span class="montant-cell">{{ number_format($paiement->montant, 2, ',', ' ') }} DH</span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</td>
                            <td>
                                @php
                                    $modeClass = match(strtolower($paiement->mode_paiement)) {
                                        'espèces', 'especes' => 'badge-especes',
                                        'chèque', 'cheque' => 'badge-cheque',
                                        'virement' => 'badge-virement',
                                        'carte bancaire', 'carte' => 'badge-carte',
                                        default => 'badge-default',
                                    };
                                @endphp
                                <span class="badge-mode {{ $modeClass }}">{{ $paiement->mode_paiement }}</span>
                            </td>
                            <td>
                                @if($paiement->statut === 'Validé')
                                    <span class="badge-mode" style="background: #dcfce7; color: #166534;"><i class="bi bi-check-all"></i> Validé</span>
                                @else
                                    <span class="badge-mode" style="background: #f1f5f9; color: #475569;"><i class="bi bi-clock"></i> En attente</span>
                                @endif
                            </td>
                            <td>{{ $paiement->comptable->nom_complet}}</td>
                            <td>
                                <span style="font-size: 0.75rem; font-weight: 700; color: var(--blue-700); background: var(--blue-50); padding: 0.2rem 0.5rem; border-radius: 6px;">
                                    {{ $paiement->region->nom}}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons justify-content-center">
                                    <a href="{{ route('paiements.show', $paiement->id) }}" class="btn-icon btn-icon-view"
                                        title="Détails">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    
                                    @if($paiement->statut !== 'Validé')
                                        <a href="{{ route('paiements.edit', $paiement->id) }}" class="btn-icon btn-icon-edit"
                                            title="Modifier">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('paiements.destroy', $paiement->id) }}" method="POST"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce paiement ?');"
                                            style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon btn-icon-delete" title="Supprimer">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn-icon" style="background: #f8fafc; color: #cbd5e1; border: 1.5px solid #e2eaf8; cursor: not-allowed;" title="Vérouillé" disabled>
                                            <i class="bi bi-lock-fill"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 4rem 2rem; color: #94a3b8;">
                                <i class="bi bi-inbox"
                                    style="font-size: 3.5rem; color: #cbd5e1; margin-bottom: 1rem; display: block;"></i>
                                <h4 style="font-size: 1.1rem; font-weight: 700; color: #475569; margin-bottom: 0.4rem;">Aucun
                                    paiement trouvé</h4>
                                <p style="font-size: 0.85rem;">Les paiements s'afficheront ici.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
