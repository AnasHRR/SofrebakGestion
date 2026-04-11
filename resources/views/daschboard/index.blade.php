@extends('_layout')
@section('title', 'Dashboard')
@section('content')

@php
    // Fetching Key Metrics dynamically (this simulates robust controllers)
    $totalCA = \App\Models\Factures::sum('montant_total') ?? 0;
    $totalCommandes = \App\Models\CommandeClient::count();
    $totalClients = \App\Models\clients::count();
    $totalProduits = \App\Models\Produits::count();
    $totalDepenses = \App\Models\commandesFournisseurs::sum('montant_total') ?? 0;
    
    // Fetching Recent Orders
    $recentCommandes = \App\Models\CommandeClient::with('client')->orderBy('date_commande', 'desc')->take(6)->get();
@endphp

<style>
    /* ── Dashboard Animations ── */
    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in {
        animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    /* ── Header Welcome ── */
    .dash-header {
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .dash-welcome {
        opacity: 0;
        animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .dash-welcome h1 {
        font-weight: 800;
        color: #0f1e4a;
        font-size: 1.8rem;
        letter-spacing: -0.5px;
        margin-bottom: 0.3rem;
    }

    .dash-welcome p {
        color: #64748b;
        font-weight: 500;
        font-size: 0.95rem;
        margin: 0;
    }

    /* ── Stats Grid ── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 1.8rem;
        box-shadow: 0 4px 15px rgba(15, 42, 110, 0.03), 0 10px 40px rgba(15, 42, 110, 0.04);
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        opacity: 0;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(15, 42, 110, 0.06), 0 20px 45px rgba(15, 42, 110, 0.08);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle at top right, var(--stat-glow), transparent 70%);
        opacity: 0.5;
        border-radius: 50%;
        transform: translate(30%, -30%);
        pointer-events: none;
    }

    /* Assigning glow colors by child */
    .stat-card:nth-child(1) { --stat-glow: #60a5fa; animation-delay: 0.1s; }
    .stat-card:nth-child(2) { --stat-glow: #a78bfa; animation-delay: 0.2s; }
    .stat-card:nth-child(3) { --stat-glow: #fbbf24; animation-delay: 0.3s; }
    .stat-card:nth-child(4) { --stat-glow: #4ade80; animation-delay: 0.4s; }

    .stat-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.2rem;
    }

    .stat-title {
        color: #64748b;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: #fff;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    /* Assigning icon background colors */
    .stat-card:nth-child(1) .stat-icon { background: linear-gradient(135deg, #3b82f6, #2563eb); box-shadow: 0 8px 20px rgba(59, 130, 246, 0.35); }
    .stat-card:nth-child(2) .stat-icon { background: linear-gradient(135deg, #8b5cf6, #7c3aed); box-shadow: 0 8px 20px rgba(139, 92, 246, 0.35); }
    .stat-card:nth-child(3) .stat-icon { background: linear-gradient(135deg, #f59e0b, #d97706); box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35); }
    .stat-card:nth-child(4) .stat-icon { background: linear-gradient(135deg, #10b981, #059669); box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35); }

    .stat-value {
        font-size: 2.2rem;
        font-weight: 800;
        color: #0f1e4a;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-subtitle {
        color: #10b981;
        font-size: 0.8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.2rem;
    }

    /* ── Main Content Grid ── */
    .main-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
    }

    .dash-panel {
        background: #ffffff;
        border-radius: 20px;
        padding: 1.8rem;
        box-shadow: 0 4px 15px rgba(15, 42, 110, 0.03);
        opacity: 0;
        animation-delay: 0.5s;
    }

    .dash-panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .dash-panel-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: #0f1e4a;
        margin: 0;
    }

    .dash-panel-action {
        color: var(--blue-600);
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .dash-panel-action:hover {
        color: var(--blue-800);
        text-decoration: underline;
    }

    /* ── Table Modern ── */
    .modern-table-wrapper {
        overflow-x: auto;
    }

    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .modern-table th {
        color: #64748b;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 0 1rem 0.5rem;
        border: none;
    }

    .modern-table tbody tr {
        background: #f8fafc;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .modern-table tbody tr:hover {
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(15, 42, 110, 0.05);
        background: #ffffff;
    }

    .modern-table td {
        padding: 1rem;
        border: none;
        font-size: 0.9rem;
        font-weight: 600;
        color: #334155;
    }

    .modern-table td:first-child { border-radius: 12px 0 0 12px; }
    .modern-table td:last-child { border-radius: 0 12px 12px 0; }

    /* Custom Badges */
    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .status-warning { background: #fef3c7; color: #d97706; }
    .status-success { background: #dcfce3; color: #059669; }
    .status-danger { background: #fee2e2; color: #dc2626; }
    .status-info { background: #dbeafe; color: #2563eb; }

    /* Responsive */
    @media (max-width: 1024px) {
        .main-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="dash-welcome">
    <h1>Bonjour, {{ Auth::check() ? Auth::user()->name : 'Admin' }}! 👋</h1>
    <p>Voici un aperçu de vos activités et de vos performances commerciales.</p>
</div>

<div class="dash-header">
    <div style="flex:1;"></div>
    <div class="dash-actions animate-fade-in" style="animation-delay: 0.1s;">
        <a href="/commandes/create" class="btn btn-primary" style="background: linear-gradient(135deg, var(--blue-600), var(--blue-800)); border: none; font-weight: 600; padding: 0.6rem 1.2rem; border-radius: 10px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);">
            <i class="bi bi-plus-lg"></i> Nouvelle Commande
        </a>
    </div>
</div>

<div class="stats-grid">
    <!-- Chiffre d'Affaire -->
    <div class="stat-card animate-fade-in">
        <div class="stat-card-header">
            <span class="stat-title">Chiffre d'Affaires</span>
            <div class="stat-icon"><i class="bi bi-currency-dollar"></i></div>
        </div>
        <div class="stat-value">{{ number_format($totalCA, 2, ',', ' ') }} Dh</div>
        <div class="stat-subtitle">
            <i class="bi bi-arrow-up-right-circle-fill"></i> Total facturé
        </div>
    </div>

    <!-- Commandes Clients -->
    <div class="stat-card animate-fade-in">
        <div class="stat-card-header">
            <span class="stat-title">Commandes Clients</span>
            <div class="stat-icon"><i class="bi bi-bag-check"></i></div>
        </div>
        <div class="stat-value">{{ $totalCommandes }}</div>
        <div class="stat-subtitle" style="color: #8b5cf6;">
            <i class="bi bi-arrow-right-circle-fill"></i> Commandes en cours
        </div>
    </div>

    <!-- Clients Actifs -->
    <div class="stat-card animate-fade-in">
        <div class="stat-card-header">
            <span class="stat-title">Clients Enregistrés</span>
            <div class="stat-icon"><i class="bi bi-people"></i></div>
        </div>
        <div class="stat-value">{{ $totalClients }}</div>
        <div class="stat-subtitle" style="color: #f59e0b;">
            <i class="bi bi-person-check-fill"></i> Base de clients
        </div>
    </div>

    <!-- Produits -->
    <div class="stat-card animate-fade-in">
        <div class="stat-card-header">
            <span class="stat-title">Produits en Stock</span>
            <div class="stat-icon"><i class="bi bi-box-seam"></i></div>
        </div>
        <div class="stat-value">{{ $totalProduits }}</div>
        <div class="stat-subtitle" style="color: #10b981;">
            <i class="bi bi-box-fill"></i> Total inventaire
        </div>
    </div>
</div>

<div class="main-grid">
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <!-- Statistiques Avancées -->
        <div class="dash-panel animate-fade-in">
            <div class="dash-panel-header">
                <h3 class="dash-panel-title">Statistiques Financières</h3>
            </div>
            <div style="display: flex; gap: 2rem; flex-wrap: wrap;">
                @php
                    $maxAmount = max($totalCA, $totalDepenses);
                    $maxAmount = $maxAmount > 0 ? $maxAmount : 1;
                    $caPercentage = ($totalCA / $maxAmount) * 100;
                    $depensesPercentage = ($totalDepenses / $maxAmount) * 100;
                @endphp
                <div style="flex: 1; min-width: 200px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-weight: 700; color: #334155;">
                        <span>Entrées (Revenus)</span>
                        <span style="color: var(--blue-600);">{{ number_format($totalCA, 0, ',', ' ') }} Dh</span>
                    </div>
                    <div style="height: 10px; background: #e2eaf8; border-radius: 5px; overflow: hidden;">
                        <div style="width: {{ $caPercentage }}%; height: 100%; background: linear-gradient(90deg, var(--blue-400), var(--blue-600)); border-radius: 5px;"></div>
                    </div>
                </div>
                
                <div style="flex: 1; min-width: 200px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-weight: 700; color: #334155;">
                        <span>Sorties (Dépenses Fournisseurs)</span>
                        <span style="color: #ef4444;">{{ number_format($totalDepenses, 0, ',', ' ') }} Dh</span>
                    </div>
                    <div style="height: 10px; background: #fee2e2; border-radius: 5px; overflow: hidden;">
                        <div style="width: {{ $depensesPercentage }}%; height: 100%; background: linear-gradient(90deg, #f87171, #ef4444); border-radius: 5px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des Commandes Récentes -->
        <div class="dash-panel animate-fade-in">
            <div class="dash-panel-header">
                <h3 class="dash-panel-title">Commandes Clientes Récentes</h3>
                <a href="/commandes" class="dash-panel-action">Voir tout</a>
            </div>
        
        <div class="modern-table-wrapper">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>N° Commande</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentCommandes as $cmd)
                        <tr>
                            <td><span style="color: var(--blue-600);">#{{ $cmd->numero_commande }}</span></td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--blue-50); color: var(--blue-700); display: flex; align-items: center; justify-content: center; font-weight: 800;">
                                        {{ substr(optional($cmd->client)->nom_entreprise ?? 'C', 0, 1) }}
                                    </div>
                                    {{ optional($cmd->client)->nom_entreprise ?? 'Client Anonyme' }}
                                </div>
                            </td>
                            <td style="color: #64748b;">{{ \Carbon\Carbon::parse($cmd->date_commande)->format('d M Y') }}</td>
                            <td>{{ number_format($cmd->montant_total, 2, ',', ' ') }} Dh</td>
                            <td>
                                @if(strtolower($cmd->statut) == 'livrée')
                                    <span class="status-badge status-success"><i class="bi bi-check-circle-fill"></i> Livrée</span>
                                @elseif(strtolower($cmd->statut) == 'en cours')
                                    <span class="status-badge status-warning"><i class="bi bi-clock-fill"></i> En cours</span>
                                @elseif(strtolower($cmd->statut) == 'annulée')
                                    <span class="status-badge status-danger"><i class="bi bi-x-circle-fill"></i> Annulée</span>
                                @else
                                    <span class="status-badge status-info"><i class="bi bi-info-circle-fill"></i> {{ $cmd->statut }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Aucune commande récente trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <!-- Section Rapide / Widget -->
    <div class="dash-panel animate-fade-in" style="animation-delay: 0.6s;">
        <div class="dash-panel-header">
            <h3 class="dash-panel-title">Raccourcis</h3>
        </div>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <a href="/clients/create" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 16px; background: #f8fafc; text-decoration: none; color: #1e293b; transition: all 0.2s ease;" onmouseover="this.style.background='#eff6ff'; this.style.transform='translateX(5px)';" onmouseout="this.style.background='#f8fafc'; this.style.transform='translateX(0)';">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, #fbbf24, #f59e0b); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25);">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <div>
                    <h6 style="margin: 0; font-weight: 800; font-size: 0.95rem;">Nouveau Client</h6>
                    <span style="font-size: 0.8rem; color: #64748b;">Ajouter un partenaire</span>
                </div>
                <i class="bi bi-chevron-right ms-auto" style="color: #cbd5e1;"></i>
            </a>

            <a href="/factures/create" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 16px; background: #f8fafc; text-decoration: none; color: #1e293b; transition: all 0.2s ease;" onmouseover="this.style.background='#eff6ff'; this.style.transform='translateX(5px)';" onmouseout="this.style.background='#f8fafc'; this.style.transform='translateX(0)';">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);">
                    <i class="bi bi-receipt"></i>
                </div>
                <div>
                    <h6 style="margin: 0; font-weight: 800; font-size: 0.95rem;">Créer Facture</h6>
                    <span style="font-size: 0.8rem; color: #64748b;">Générer une facturation</span>
                </div>
                <i class="bi bi-chevron-right ms-auto" style="color: #cbd5e1;"></i>
            </a>

            <a href="/stock" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 16px; background: #f8fafc; text-decoration: none; color: #1e293b; transition: all 0.2s ease;" onmouseover="this.style.background='#eff6ff'; this.style.transform='translateX(5px)';" onmouseout="this.style.background='#f8fafc'; this.style.transform='translateX(0)';">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; box-shadow: 0 4px 12px rgba(139, 92, 246, 0.25);">
                    <i class="bi bi-boxes"></i>
                </div>
                <div>
                    <h6 style="margin: 0; font-weight: 800; font-size: 0.95rem;">Gérer le Stock</h6>
                    <span style="font-size: 0.8rem; color: #64748b;">Mouvements récents</span>
                </div>
                <i class="bi bi-chevron-right ms-auto" style="color: #cbd5e1;"></i>
            </a>
        </div>
    </div>
</div>

@endsection
