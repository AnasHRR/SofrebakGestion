@extends('_layout')

@section('title' , 'Client - Details')

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
        background: #fff;
        color: #64748b;
        font-size: 0.84rem;
        font-weight: 700;
        padding: 0.55rem 1.1rem;
        border-radius: 10px;
        text-decoration: none;
        border: 1.5px solid #e2eaf8;
        box-shadow: 0 1px 4px rgba(15,42,110,0.05);
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background: var(--blue-50);
        border-color: var(--blue-100);
        color: var(--blue-600);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(29,78,216,0.1);
    }

    .btn-edit-main {
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

    .btn-edit-main:hover {
        box-shadow: 0 6px 20px rgba(29,78,216,0.5);
        transform: translateY(-1px);
        color: #fff;
    }

    /* ── Detail Card ── */
    .detail-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    .detail-card:hover {
        box-shadow: 0 8px 28px rgba(29,78,216,0.1);
    }

    /* Card Header */
    .detail-card-header {
        background: linear-gradient(135deg, var(--blue-700), var(--blue-900));
        padding: 1.6rem 1.8rem;
        display: flex;
        align-items: center;
        gap: 1.1rem;
        position: relative;
        overflow: hidden;
    }

    .detail-card-header::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 160px;
        height: 160px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }

    .detail-card-header::after {
        content: '';
        position: absolute;
        bottom: -60px;
        left: -30px;
        width: 120px;
        height: 120px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
    }

    .detail-avatar {
        width: 60px;
        height: 60px;
        background: rgba(255,255,255,0.15);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 2px solid rgba(255,255,255,0.2);
        position: relative;
        z-index: 1;
    }

    .detail-avatar i {
        color: #fff;
        font-size: 1.6rem;
    }

    .detail-header-info {
        flex: 1;
        min-width: 0;
        position: relative;
        z-index: 1;
    }

    .detail-name {
        font-size: 1.25rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 6px;
    }

    .detail-badges {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .detail-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: rgba(255,255,255,0.15);
        border-radius: 7px;
        padding: 3px 10px;
        font-size: 0.7rem;
        color: rgba(255,255,255,0.85);
        font-weight: 600;
        letter-spacing: 0.3px;
        backdrop-filter: blur(4px);
    }

    .detail-badge i {
        font-size: 0.65rem;
    }

    /* Card Body */
    .detail-card-body {
        padding: 1.5rem 1.8rem;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
    }

    .detail-field {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        padding: 1rem 0.5rem;
        border-bottom: 1px solid #f1f5fb;
        transition: background 0.2s ease;
        border-radius: 10px;
        margin: 0 -0.5rem;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .detail-field:hover {
        background: #f8faff;
    }

    .detail-field.full-width {
        grid-column: 1 / -1;
    }

    .detail-field:last-child {
        border-bottom: none;
    }

    .detail-field-icon {
        width: 38px;
        height: 38px;
        background: #eff6ff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 2px;
        transition: all 0.2s ease;
    }

    .detail-field:hover .detail-field-icon {
        background: var(--blue-500);
    }

    .detail-field-icon i {
        color: var(--blue-600);
        font-size: 0.95rem;
        transition: color 0.2s ease;
    }

    .detail-field:hover .detail-field-icon i {
        color: #fff;
    }

    .detail-field-content {
        flex: 1;
        min-width: 0;
    }

    .detail-field-label {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #94a3b8;
        line-height: 1;
        margin-bottom: 5px;
    }

    .detail-field-value {
        font-size: 0.92rem;
        font-weight: 600;
        color: #1e293b;
        word-break: break-word;
        line-height: 1.4;
    }

    .detail-field-value a {
        color: var(--blue-600);
        text-decoration: none;
        transition: color 0.2s;
    }

    .detail-field-value a:hover {
        color: var(--blue-800);
        text-decoration: underline;
    }

    /* Region Badge */
    .region-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
        color: #fff;
        padding: 0.3rem 0.75rem;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(29,78,216,0.25);
    }

    /* Credit Badge */
    .credit-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: #f0fdf4;
        color: #16a34a;
        padding: 0.3rem 0.75rem;
        border-radius: 8px;
        font-size: 0.88rem;
        font-weight: 700;
        border: 1px solid #bbf7d0;
    }

    /* Card Footer */
    .detail-card-footer {
        display: flex;
        gap: 0.8rem;
        padding: 1.1rem 1.8rem;
        border-top: 1px solid #f1f5fb;
        background: #fafbff;
    }

    .btn-footer {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.45rem;
        padding: 0.6rem 1rem;
        border-radius: 10px;
        font-size: 0.84rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .btn-footer-edit {
        background: #eff6ff;
        color: var(--blue-600);
        border: 1.5px solid #bfdbfe;
    }

    .btn-footer-edit:hover {
        background: var(--blue-600);
        color: #fff;
        border-color: var(--blue-600);
        box-shadow: 0 4px 14px rgba(29,78,216,0.3);
        transform: translateY(-1px);
    }

    .btn-footer-delete {
        background: #fff5f5;
        color: #ef4444;
        border: 1.5px solid #fecaca;
    }

    .btn-footer-delete:hover {
        background: #ef4444;
        color: #fff;
        border-color: #ef4444;
        box-shadow: 0 4px 14px rgba(239,68,68,0.3);
        transform: translateY(-1px);
    }

    .btn-footer-back {
        background: #f8fafc;
        color: #64748b;
        border: 1.5px solid #e2eaf8;
    }

    .btn-footer-back:hover {
        background: #e2eaf8;
        color: #475569;
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .page-header-actions {
            width: 100%;
            display: flex;
            gap: 0.5rem;
        }

        .page-header-actions a {
            flex: 1;
            justify-content: center;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-card-header {
            padding: 1.2rem 1.3rem;
        }

        .detail-card-body {
            padding: 1rem 1.3rem;
        }

        .detail-card-footer {
            padding: 1rem 1.3rem;
            flex-wrap: wrap;
        }

        .detail-card-footer .btn-footer {
            min-width: calc(50% - 0.4rem);
        }

        .detail-name {
            font-size: 1.1rem;
        }

        .detail-avatar {
            width: 50px;
            height: 50px;
        }

        .detail-avatar i {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 480px) {
        .detail-card-footer {
            flex-direction: column;
        }

        .detail-card-footer .btn-footer {
            min-width: 100%;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-person-vcard-fill me-2" style="color:var(--blue-500);"></i>Détails du Client</h2>
        <p>Informations complètes sur le client</p>
    </div>
    <div class="page-header-actions" style="display: flex; gap: 0.6rem;">
        <a href="{{ route('clients.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
        <a href="{{ route('clients.edit', $client->id) }}" class="btn-edit-main">
            <i class="bi bi-pencil-fill"></i> Modifier
        </a>
    </div>
</div>

<!-- Detail Card -->
<div class="detail-card">

    <!-- Header -->
    <div class="detail-card-header">
        <div class="detail-avatar">
            <i class="bi bi-person-fill"></i>
        </div>
        <div class="detail-header-info">
            <div class="detail-name">{{ $client->personne_contact }}</div>
            <div class="detail-badges">
                @if($client->nom_entreprise)
                    <span class="detail-badge">
                        <i class="bi bi-building"></i> {{ $client->nom_entreprise }}
                    </span>
                @endif
                @if($client->region)
                    <span class="detail-badge">
                        <i class="bi bi-geo-alt-fill"></i> {{ $client->region->nom }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Body -->
    <div class="detail-card-body">
        <div class="detail-grid">

            <!-- Entreprise -->
            <div class="detail-field">
                <div class="detail-field-icon">
                    <i class="bi bi-building"></i>
                </div>
                <div class="detail-field-content">
                    <div class="detail-field-label">Entreprise</div>
                    <div class="detail-field-value">{{ $client->nom_entreprise ?? '—' }}</div>
                </div>
            </div>

            <!-- Téléphone -->
            <div class="detail-field">
                <div class="detail-field-icon">
                    <i class="bi bi-telephone-fill"></i>
                </div>
                <div class="detail-field-content">
                    <div class="detail-field-label">Téléphone</div>
                    <div class="detail-field-value">
                        @if($client->telephone)
                            <a href="tel:{{ $client->telephone }}">{{ $client->telephone }}</a>
                        @else
                            —
                        @endif
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="detail-field">
                <div class="detail-field-icon">
                    <i class="bi bi-envelope-fill"></i>
                </div>
                <div class="detail-field-content">
                    <div class="detail-field-label">Email</div>
                    <div class="detail-field-value">
                        @if($client->email)
                            <a href="mailto:{{ $client->email }}">{{ $client->email }}</a>
                        @else
                            —
                        @endif
                    </div>
                </div>
            </div>

            <!-- Région -->
            <div class="detail-field">
                <div class="detail-field-icon">
                    <i class="bi bi-map-fill"></i>
                </div>
                <div class="detail-field-content">
                    <div class="detail-field-label">Région</div>
                    <div class="detail-field-value">
                        @if($client->region)
                            <span class="region-badge">
                                <i class="bi bi-pin-map-fill"></i> {{ $client->region->nom }}
                            </span>
                        @else
                            —
                        @endif
                    </div>
                </div>
            </div>

            <!-- Adresse -->
            <div class="detail-field full-width">
                <div class="detail-field-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="detail-field-content">
                    <div class="detail-field-label">Adresse</div>
                    <div class="detail-field-value">{{ $client->adresse ?? '—' }}</div>
                </div>
            </div>

            <!-- Plafond Crédit -->
            <div class="detail-field full-width">
                <div class="detail-field-icon">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div class="detail-field-content">
                    <div class="detail-field-label">Plafond de Crédit</div>
                    <div class="detail-field-value">
                        <span class="credit-badge">
                            <i class="bi bi-check-circle-fill" style="font-size:0.75rem;"></i>
                            {{ number_format($client->plafond_credit, 2, ',', ' ') }} DH
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <div class="detail-card-footer">
        <a href="{{ route('clients.index') }}" class="btn-footer btn-footer-back">
            <i class="bi bi-arrow-return-left"></i> Retour à la liste
        </a>
        <a href="{{ route('clients.edit', $client->id) }}" class="btn-footer btn-footer-edit">
            <i class="bi bi-pencil-fill"></i> Modifier
        </a>
        <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
              onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?');" style="flex:1;display:flex;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-footer btn-footer-delete">
                <i class="bi bi-trash-fill"></i> Supprimer
            </button>
        </form>
    </div>

</div>
@endsection