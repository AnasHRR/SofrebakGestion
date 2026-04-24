@extends('_layout')
@section('title', 'Ajouter une Facture')
@section('content')

<style>
    /* ── Page Header ── */
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

    /* ── Form Card ── */
    .form-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    .form-card:hover {
        box-shadow: 0 8px 28px rgba(29,78,216,0.1);
    }

    /* Card Header */
    .form-card-header {
        background: linear-gradient(135deg, var(--blue-700), var(--blue-900));
        padding: 1.4rem 1.8rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        overflow: hidden;
    }

    .form-card-header::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 160px; height: 160px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }

    .form-card-header::after {
        content: '';
        position: absolute;
        bottom: -60px; left: -30px;
        width: 120px; height: 120px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
    }

    .form-header-icon {
        width: 48px; height: 48px;
        background: rgba(255,255,255,0.15);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        border: 2px solid rgba(255,255,255,0.2);
        position: relative; z-index: 1;
    }

    .form-header-icon i { color: #fff; font-size: 1.3rem; }

    .form-header-info { position: relative; z-index: 1; }

    .form-header-title {
        font-size: 1.1rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
    }

    .form-header-sub {
        font-size: 0.75rem;
        color: rgba(255,255,255,0.6);
        font-weight: 500;
        margin-top: 3px;
    }

    /* Card Body */
    .form-card-body {
        padding: 1.8rem;
    }

    /* Section Dividers */
    .form-section {
        margin-bottom: 1.6rem;
    }

    .form-section-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--blue-600);
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #eff6ff;
    }

    .form-section-title i {
        font-size: 0.9rem;
    }

    /* Form Grid */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.2rem;
    }

    .form-group {
        margin-bottom: 0.2rem;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #475569;
        margin-bottom: 0.45rem;
    }

    .form-group label i {
        color: var(--blue-500);
        font-size: 0.85rem;
    }

    .form-group label .required {
        color: #ef4444;
        font-weight: 800;
    }

    /* Custom Inputs */
    .custom-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .custom-input-icon {
        position: absolute;
        left: 0;
        width: 44px; height: 100%;
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, var(--blue-600), var(--blue-800));
        border-radius: 10px 0 0 10px;
        z-index: 2;
    }

    .custom-input-icon i { color: #fff; font-size: 0.9rem; }

    .custom-input {
        width: 100%;
        padding: 0.65rem 0.9rem 0.65rem 3.2rem;
        border: 1.5px solid #e2eaf8;
        border-radius: 10px;
        font-size: 0.88rem;
        font-weight: 500;
        color: #1e293b;
        background: #fff;
        outline: none;
        transition: all 0.25s ease;
        font-family: inherit;
    }

    .custom-input:focus {
        border-color: var(--blue-400);
        box-shadow: 0 0 0 4px rgba(96,165,250,0.15);
        background: #fafbff;
    }

    .custom-input::placeholder {
        color: #94a3b8;
        font-weight: 400;
    }

    .custom-input.is-invalid {
        border-color: #fca5a5;
        box-shadow: 0 0 0 4px rgba(239,68,68,0.1);
    }

    .custom-select {
        width: 100%;
        padding: 0.65rem 0.9rem 0.65rem 3.2rem;
        border: 1.5px solid #e2eaf8;
        border-radius: 10px;
        font-size: 0.88rem;
        font-weight: 500;
        color: #1e293b;
        background: #fff;
        outline: none;
        transition: all 0.25s ease;
        font-family: inherit;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 16 16'%3E%3Cpath fill='%2364748b' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 2.5rem;
    }

    .custom-select:focus {
        border-color: var(--blue-400);
        box-shadow: 0 0 0 4px rgba(96,165,250,0.15);
        background-color: #fafbff;
    }

    /* Currency input */
    .currency-wrapper {
        display: flex;
        align-items: stretch;
        width: 100%;
    }

    .currency-wrapper .custom-input {
        border-radius: 10px 0 0 10px;
        flex: 1;
    }

    .currency-suffix {
        display: flex;
        align-items: center;
        padding: 0 0.85rem;
        background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
        color: #fff;
        font-size: 0.82rem;
        font-weight: 700;
        border-radius: 0 10px 10px 0;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    /* Info Box */
    .info-box {
        background: #eff6ff;
        border: 1px solid var(--blue-100);
        border-radius: 12px;
        padding: 0.85rem 1.1rem;
        display: flex;
        align-items: flex-start;
        gap: 0.7rem;
        margin-bottom: 1.2rem;
    }

    .info-box i {
        color: var(--blue-500);
        font-size: 1rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .info-box p {
        font-size: 0.82rem;
        color: #475569;
        margin: 0;
        line-height: 1.5;
    }

    .invalid-feedback {
        display: block;
        font-size: 0.76rem;
        color: #ef4444;
        font-weight: 600;
        margin-top: 0.3rem;
        padding-left: 0.2rem;
    }

    /* Card Footer */
    .form-card-footer {
        display: flex;
        justify-content: flex-end;
        gap: 0.7rem;
        padding: 1.2rem 1.8rem;
        border-top: 1px solid #f1f5fb;
        background: #fafbff;
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.6rem 1.2rem;
        border-radius: 10px;
        font-size: 0.84rem;
        font-weight: 600;
        text-decoration: none;
        border: 1.5px solid #e2eaf8;
        background: #f8fafc;
        color: #64748b;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-cancel:hover {
        background: #e2eaf8;
        color: #475569;
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }

    .btn-reset {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.6rem 1.2rem;
        border-radius: 10px;
        font-size: 0.84rem;
        font-weight: 600;
        text-decoration: none;
        border: 1.5px solid #fed7aa;
        background: #fff7ed;
        color: #ea580c;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-reset:hover {
        background: #ea580c;
        color: #fff;
        border-color: #ea580c;
        transform: translateY(-1px);
    }

    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.6rem 1.6rem;
        border-radius: 10px;
        font-size: 0.84rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
        color: #fff;
        border: none;
        box-shadow: 0 4px 14px rgba(29,78,216,0.35);
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-save:hover {
        box-shadow: 0 6px 20px rgba(29,78,216,0.5);
        transform: translateY(-1px);
    }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .form-card-body {
            padding: 1.3rem;
        }

        .form-card-header {
            padding: 1.2rem 1.3rem;
        }

        .form-card-footer {
            padding: 1rem 1.3rem;
            flex-direction: column;
        }

        .form-card-footer .btn-cancel,
        .form-card-footer .btn-reset,
        .form-card-footer .btn-save {
            width: 100%;
            justify-content: center;
        }
    }
    /* Products Table Styles */
    .products-table-section {
        margin-top: 2rem;
        background: #fff;
        border: 1.5px solid #e2eaf8;
        border-radius: 14px;
        overflow: hidden;
    }

    .products-table {
        width: 100%;
        border-collapse: collapse;
    }

    .products-table thead th {
        background: #f8fafc;
        padding: 0.8rem 1rem;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #64748b;
        border-bottom: 2px solid #e2eaf8;
        text-align: left;
    }

    .products-table tbody td {
        padding: 0.8rem 1rem;
        border-bottom: 1px solid #f1f5fb;
    }

    .table-input {
        width: 100%;
        padding: 0.4rem 0.6rem;
        border: 1.2px solid #e2eaf8;
        border-radius: 8px;
        font-size: 0.85rem;
    }

    .btn-auto-fill {
        background: var(--blue-500);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .btn-auto-fill:hover {
        background: var(--blue-600);
        transform: translateY(-1px);
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-receipt me-2" style="color:var(--blue-500);"></i>Nouvelle Facture</h2>
        <p>Créer une nouvelle facture pour un client</p>
    </div>
    <a href="{{ route('factures.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Retour aux factures
    </a>
</div>

<!-- Form Card -->
<div class="form-card">

    <!-- Header -->
    <div class="form-card-header">
        <div class="form-header-icon">
            <i class="bi bi-receipt-cutoff"></i>
        </div>
        <div class="form-header-info">
            <div class="form-header-title">Détails de la Facture</div>
            <div class="form-header-sub">Remplissez les informations pour créer la facture</div>
        </div>
    </div>

    <!-- Body -->
    <div class="form-card-body">
        <form action="{{ route('factures.store') }}" method="POST" id="createFactureForm">
            @csrf

            <!-- Section: Client & Référence -->
            <div class="form-section">
                <div class="form-section-title">
                    <i class="bi bi-person-fill"></i> Client & Référence
                </div>

                <div class="info-box">
                    <i class="bi bi-info-circle-fill"></i>
                    <p>Sélectionnez le client associé à cette facture. Le sous-total sera automatiquement rempli avec le crédit actuel du client.</p>
                </div>

                <div class="form-row">
                    <!-- Client -->
                    <div class="form-group">
                        <label for="client_id">
                            <i class="bi bi-person-badge-fill"></i> Client <span class="required">*</span>
                        </label>
                        <div class="custom-input-wrapper">
                            <div class="custom-input-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            <select name="client_id" id="client_id"
                                    class="custom-select @error('client_id') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Choisir un client --</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" 
                                            data-credit="{{ $client->calculated_credit }}"
                                            {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                        {{ $client->nom_entreprise }} (Crédit: {{ number_format($client->calculated_credit, 2, ',', ' ') }} DH)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('client_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Numéro Facture -->
                    <div class="form-group">
                        <label for="numero_facture">
                            <i class="bi bi-hash"></i> Numéro de Facture <span class="required">*</span>
                        </label>
                        <div class="custom-input-wrapper">
                            <div class="custom-input-icon">
                                <i class="bi bi-hash"></i>
                            </div>
                            <input type="text" id="numero_facture"  name="numero_facture"
                                   class="custom-input @error('numero_facture') is-invalid @enderror"
                                   value="{{ 'FACT-'. rand(100000, 999999) }} "
                                   readonly
                                   placeholder="Ex: FAC-2026-001" required>
                        </div>
                        @error('numero_facture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Dates -->
            <div class="form-section">
                <div class="form-section-title">
                    <i class="bi bi-calendar3"></i> Dates
                </div>

                <div class="form-row">
                    <!-- Date Facture -->
                    <div class="form-group">
                        <label for="date_facture">
                            <i class="bi bi-calendar-event"></i> Date de Facture <span class="required">*</span>
                        </label>
                        <div class="custom-input-wrapper">
                            <div class="custom-input-icon">
                                <i class="bi bi-calendar3"></i>
                            </div>
                            <input type="date" id="date_facture" name="date_facture"
                                   class="custom-input @error('date_facture') is-invalid @enderror"
                                   value="{{ old('date_facture', date('Y-m-d')) }}" required>
                        </div>
                        @error('date_facture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date Échéance -->
                    <div class="form-group">
                        <label for="date_echeance">
                            <i class="bi bi-calendar-check"></i> Date d'Échéance
                        </label>
                        <div class="custom-input-wrapper">
                            <div class="custom-input-icon">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <input type="date" id="date_echeance" name="date_echeance"
                                   class="custom-input @error('date_echeance') is-invalid @enderror"
                                   value="{{ old('date_echeance') }}">
                        </div>
                        @error('date_echeance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date Règlement -->
                    <div class="form-group">
                        <label for="date_reglement">
                            <i class="bi bi-calendar-check-fill"></i> Date de Règlement
                        </label>
                        <div class="custom-input-wrapper">
                            <div class="custom-input-icon">
                                <i class="bi bi-calendar-check-fill"></i>
                            </div>
                            <input type="date" id="date_reglement" name="date_reglement"
                                   class="custom-input @error('date_reglement') is-invalid @enderror"
                                   value="{{ old('date_reglement') }}">
                        </div>
                        @error('date_reglement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Montants -->
            <div class="form-section">
                <div class="form-section-title">
                    <i class="bi bi-cash-stack"></i> Montants
                </div>

                <div class="form-row">
                    <!-- Sous Total -->
                    <div class="form-group">
                        <label for="sous_total">
                            <i class="bi bi-calculator"></i> Sous Total <span class="required">*</span>
                        </label>
                        <div class="custom-input-wrapper">
                            <div class="custom-input-icon">
                                <i class="bi bi-calculator"></i>
                            </div>
                            <div class="currency-wrapper">
                                <input type="number" step="0.01" id="sous_total" name="sous_total"
                                       class="custom-input @error('sous_total') is-invalid @enderror"
                                       value="{{ old('sous_total') }}"
                                       placeholder="0.00" required>
                                <span class="currency-suffix">DH</span>
                            </div>
                        </div>
                        @error('sous_total')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Montant TVA -->
                    <div class="form-group">
                        <label for="montant_tva">
                            <i class="bi bi-percent"></i> Montant TVA <span class="required">*</span>
                        </label>
                        <div class="custom-input-wrapper">
                            <div class="custom-input-icon">
                                <i class="bi bi-percent"></i>
                            </div>
                            <div class="currency-wrapper">
                                <input type="number" step="0.01" id="montant_tva" name="montant_tva"
                                       class="custom-input @error('montant_tva') is-invalid @enderror"
                                       value="{{ old('montant_tva') }}"
                                       placeholder="0.00" required>
                                <span class="currency-suffix">DH</span>
                            </div>
                        </div>
                        @error('montant_tva')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Montant Total -->
                    <div class="form-group">
                        <label for="montant_total">
                            <i class="bi bi-cash"></i> Montant Total <span class="required">*</span>
                        </label>
                        <div class="custom-input-wrapper">
                            <div class="custom-input-icon">
                                <i class="bi bi-cash"></i>
                            </div>
                            <div class="currency-wrapper">
                                <input type="number" step="0.01" id="montant_total" name="montant_total"
                                       class="custom-input @error('montant_total') is-invalid @enderror"
                                       value="{{ old('montant_total') }}"
                                       placeholder="0.00" required>
                                <span class="currency-suffix">DH</span>
                            </div>
                        </div>
                        @error('montant_total')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Montant Payé -->
                    <div class="form-group">
                        <label for="montant_paye">
                            <i class="bi bi-wallet2"></i> Montant Payé
                        </label>
                        <div class="custom-input-wrapper">
                            <div class="custom-input-icon">
                                <i class="bi bi-wallet2"></i>
                            </div>
                            <div class="currency-wrapper">
                                <input type="number" step="0.01" id="montant_paye" name="montant_paye"
                                       class="custom-input @error('montant_paye') is-invalid @enderror"
                                       value="{{ old('montant_paye', 0) }}"
                                       placeholder="0.00">
                                <span class="currency-suffix" style="border-radius:0;">DH</span>
                                <button type="button" class="btn-auto-fill" id="btn-generate-products" title="Générer des produits aléatoires" style="border-radius: 0 10px 10px 0; height: 100%;">
                                    <i class="bi bi-magic"></i>
                                </button>
                            </div>
                        </div>
                        @error('montant_paye')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Produits Aléatoires -->
            <div class="form-section">
                <div class="form-section-title">
                    <i class="bi bi-box-seam"></i> Produits Suggestion (Visualisation)
                </div>
                
                <div class="products-table-section">
                    <table class="products-table" id="facture-products-table">
                        <thead>
                            <tr>
                                <th style="width: 40%;">Produit</th>
                                <th style="width: 20%;">Quantité</th>
                                <th style="width: 20%;">Prix Unit. (DH)</th>
                                <th style="width: 20%;">Total (DH)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Will be populated by JS -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section: Statut -->
            <div class="form-section" style="margin-bottom:0;">
                <div class="form-section-title">
                    <i class="bi bi-flag"></i> Statut
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="statut">
                            <i class="bi bi-flag-fill"></i> Statut de la facture <span class="required">*</span>
                        </label>
                        <div class="custom-input-wrapper">
                            <div class="custom-input-icon">
                                <i class="bi bi-flag"></i>
                            </div>
                            <select name="statut" id="statut"
                                    class="custom-select @error('statut') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Choisir un statut --</option>
                                <option value="Non payée" {{ old('statut') == 'Non payée' ? 'selected' : '' }}>Non payée</option>
                                <option value="Partiellement payée" {{ old('statut') == 'Partiellement payée' ? 'selected' : '' }}>Partiellement payée</option>
                                <option value="Payée" {{ old('statut') == 'Payée' ? 'selected' : '' }}>Payée</option>
                                <option value="Annulée" {{ old('statut') == 'Annulée' ? 'selected' : '' }}>Annulée</option>
                            </select>
                        </div>
                        @error('statut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <div class="form-card-footer">
        <a href="{{ route('factures.index') }}" class="btn-cancel">
            <i class="bi bi-x-circle"></i> Annuler
        </a>
        <button type="reset" form="createFactureForm" class="btn-reset">
            <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
        </button>
        <button type="submit" form="createFactureForm" class="btn-save">
            <i class="bi bi-check2-circle"></i> Créer la Facture
        </button>
    </div>

</div>

<script>
    // Inject products data for auto-fill
    const availableProduits = @json($produits);

    // Auto-calculate TVA (20%), total, and update status based on payment
    document.addEventListener('DOMContentLoaded', function() {
        const clientSelect = document.getElementById('client_id');
        const sousTotal = document.getElementById('sous_total');
        const montantTva = document.getElementById('montant_tva');
        const montantTotal = document.getElementById('montant_total');
        const montantPaye = document.getElementById('montant_paye');
        const statutSelect = document.getElementById('statut');
        
        const generateBtn = document.getElementById('btn-generate-products');
        const productsTableBody = document.querySelector('#facture-products-table tbody');

        function formatCurrency(value) {
            return parseFloat(value).toFixed(2);
        }

        if (clientSelect) {
            clientSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const credit = selectedOption.getAttribute('data-credit');
                if (credit) {
                    // Credit is Total TTC
                    montantTotal.value = parseFloat(credit).toFixed(2);
                    updateCalculationsFromTotal();
                }
            });
        }

        function updateCalculationsFromTotal() {
            const total = parseFloat(montantTotal.value) || 0;
            const st = total / 1.20;
            sousTotal.value = st.toFixed(2);
            const tva = total - st;
            montantTva.value = tva.toFixed(2);
            
            // Update max for payment
            montantPaye.max = total.toFixed(2);
            
            updateStatus();
        }

        function updateCalculations() {
            const st = parseFloat(sousTotal.value) || 0;
            const tva = st * 0.20;
            montantTva.value = tva.toFixed(2);
            const total = st + tva;
            montantTotal.value = total.toFixed(2);
            
            // Update max for payment
            montantPaye.max = total.toFixed(2);
            
            updateStatus();
        }

        function calcTotal() {
            const st = parseFloat(sousTotal.value) || 0;
            const tva = parseFloat(montantTva.value) || 0;
            const total = st + tva;
            montantTotal.value = total.toFixed(2);
            
            // Update max for payment
            montantPaye.max = total.toFixed(2);
            
            updateStatus();
        }

        function updateStatus() {
            const total = parseFloat(montantTotal.value) || 0;
            let paye = parseFloat(montantPaye.value) || 0;

            if (total === 0) {
                statutSelect.value = "Non payée";
                return;
            }

            if (paye <= 0) {
                statutSelect.value = "Non payée";
            } else if (paye < total) {
                statutSelect.value = "Partiellement payée";
            } else {
                statutSelect.value = "Payée";
            }
        }

        function addProductRow(produitId, produitName, quantite, prix) {
            const total = quantite * prix;
            const rowIdx = productsTableBody.children.length;
            const row = `
                <tr>
                    <td>
                        <input type="text" class="table-input" value="${produitName}" readonly>
                        <input type="hidden" name="produits[${rowIdx}][produit_id]" value="${produitId}">
                    </td>
                    <td>
                        <input type="number" class="table-input" value="${quantite}" readonly name="produits[${rowIdx}][quantite]">
                    </td>
                    <td>
                        <input type="text" class="table-input" value="${formatCurrency(prix)}" readonly name="produits[${rowIdx}][prix_unitaire]">
                    </td>
                    <td>
                        <input type="text" class="table-input" value="${formatCurrency(total)}" readonly name="produits[${rowIdx}][total]">
                    </td>
                </tr>
            `;
            productsTableBody.insertAdjacentHTML('beforeend', row);
        }

        generateBtn.addEventListener('click', function() {
            const targetAmount = parseFloat(montantPaye.value);
            if (isNaN(targetAmount) || targetAmount <= 0) {
                alert("Veuillez entrer un montant payé valide pour générer des produits.");
                return;
            }

            // Clear table
            productsTableBody.innerHTML = '';

            let currentTotal = 0;
            const maxAttempts = 50;
            let attempts = 0;

            const validProducts = availableProduits.filter(p => p.prix_vente > 0);
            if (validProducts.length === 0) {
                alert("Aucun produit disponible pour la génération.");
                return;
            }

            while (currentTotal < targetAmount && attempts < maxAttempts) {
                const remaining = targetAmount - currentTotal;
                let possibleProducts = validProducts.filter(p => p.prix_vente <= remaining);
                
                if (possibleProducts.length === 0) {
                    // Just take the cheapest one and add 1
                    const cheapest = validProducts.sort((a,b) => a.prix_vente - b.prix_vente)[0];
                    if (cheapest) {
                        addProductRow(cheapest.id, cheapest.nom_produit, 1, cheapest.prix_vente);
                        currentTotal += cheapest.prix_vente;
                    }
                    break;
                }

                const product = possibleProducts[Math.floor(Math.random() * possibleProducts.length)];
                let maxQty = Math.floor(remaining / product.prix_vente);
                maxQty = Math.min(maxQty, 5); // Max 5 per row for variety
                
                const qty = Math.floor(Math.random() * maxQty) + 1;
                addProductRow(product.id, product.nom_produit, qty, product.prix_vente);
                currentTotal += qty * product.prix_vente;
                attempts++;
            }

            // Sync the products but do NOT change the invoice total fields
            // montantTotal.value = formatCurrency(currentTotal); // REMOVED
            // updateCalculationsFromTotal(); // REMOVED
            
            // We also don't change montantPaye as requested
            updateStatus();
        });

        if (sousTotal && montantTva && montantTotal && montantPaye && statutSelect) {
            sousTotal.addEventListener('input', updateCalculations);
            montantTva.addEventListener('input', calcTotal);
            montantPaye.addEventListener('input', updateStatus);
            
            montantTotal.addEventListener('input', function() {
                updateCalculationsFromTotal();
            });
        }
    });
</script>

@endsection