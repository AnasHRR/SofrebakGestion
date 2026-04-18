@extends('_layout')
@section('title', 'Modifier la facture ' . $facture->numero_facture)

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
            box-shadow: 0 1px 4px rgba(15, 42, 110, 0.05);
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            background: var(--blue-50);
            border-color: var(--blue-100);
            color: var(--blue-600);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.1);
        }

        /* ── Form Card ── */
        .form-card {
            background: #ffffff;
            border: 1px solid #e2eaf8;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(15, 42, 110, 0.06);
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }

        .form-card:hover {
            box-shadow: 0 8px 28px rgba(29, 78, 216, 0.1);
        }

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
            top: -40px;
            right: -40px;
            width: 160px;
            height: 160px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
        }

        .form-card-header::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -30px;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 50%;
        }

        .form-header-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 2px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 1;
        }

        .form-header-icon i {
            color: #fff;
            font-size: 1.3rem;
        }

        .form-header-info {
            position: relative;
            z-index: 1;
        }

        .form-header-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
        }

        .form-header-sub {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 500;
            margin-top: 3px;
        }

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
            width: 44px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--blue-600), var(--blue-800));
            border-radius: 10px 0 0 10px;
            z-index: 2;
        }

        .custom-input-icon i {
            color: #fff;
            font-size: 0.9rem;
        }

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
            box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.15);
            background: #fafbff;
        }

        .custom-input::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .custom-input.is-invalid {
            border-color: #fca5a5;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
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
            box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.15);
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
            box-shadow: 0 4px 14px rgba(29, 78, 216, 0.35);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-save:hover {
            box-shadow: 0 6px 20px rgba(29, 78, 216, 0.5);
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
            .form-card-footer .btn-save {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h2><i class="bi bi-pencil-square me-2" style="color:var(--blue-500);"></i>Modifier la Facture</h2>
            <p>Mise à jour de la facture <strong>{{ $facture->numero_facture }}</strong></p>
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
                <div class="form-header-title">{{ $facture->numero_facture }}</div>
                <div class="form-header-sub">Modifier les informations de la facture</div>
            </div>
        </div>

        <!-- Body -->
        <div class="form-card-body">
            <form action="{{ route('factures.update', $facture->id) }}" method="POST" id="editFactureForm">
                @csrf
                @method('PUT')

                <!-- Section: Commande & Référence -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="bi bi-link-45deg"></i> Commande & Référence
                    </div>

                    <div class="form-row">
                        <!-- Commande Client -->
                        <div class="form-group">
                            <label for="commande_client_id">
                                <i class="bi bi-bag-fill"></i> Commande Client <span class="required">*</span>
                            </label>
                            <div class="custom-input-wrapper">
                                <div class="custom-input-icon">
                                    <i class="bi bi-bag"></i>
                                </div>
                                <select name="commande_client_id" id="commande_client_id"
                                    class="custom-select @error('commande_client_id') is-invalid @enderror" required>
                                    <option value="" disabled>-- Choisir une commande --</option>
                                    @foreach ($commandes as $commande)
                                        <option value="{{ $commande->id }}" {{ old('commande_client_id', $facture->commande_client_id) == $commande->id ? 'selected' : '' }}>
                                            {{ $commande->numero_commande }} —
                                            {{ $commande->client->nom_entreprise ?? 'Client' }}
                                            ({{ number_format($commande->montant_total, 2, ',', ' ') }} DH)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('commande_client_id')
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
                                <input type="text" id="numero_facture" name="numero_facture"
                                    class="custom-input @error('numero_facture') is-invalid @enderror"
                                    value="{{ old('numero_facture', $facture->numero_facture) }}"
                                    placeholder="Ex: Fact-2026-001" required>
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
                                    value="{{ old('date_facture', $facture->date_facture) }}" required>
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
                                    value="{{ old('date_echeance', $facture->date_echeance) }}">
                            </div>
                            @error('date_echeance')
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
                                        value="{{ old('sous_total', $facture->sous_total) }}" placeholder="0.00" required>
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
                                        value="{{ old('montant_tva', $facture->montant_tva) }}" placeholder="0.00" required>
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
                                        value="{{ old('montant_total', $facture->montant_total) }}" placeholder="0.00"
                                        required>
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
                                        value="{{ old('montant_paye', $facture->montant_paye) }}" placeholder="0.00">
                                    <span class="currency-suffix">DH</span>
                                </div>
                            </div>
                            @error('montant_paye')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
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
                                    <option value="" disabled>-- Choisir un statut --</option>
                                    <option value="Non payée" {{ old('statut', $facture->statut) == 'Non payée' || old('statut', $facture->statut) == 'Impayée' ? 'selected' : '' }}>Non payée</option>
                                    <option value="Partiellement payée" {{ old('statut', $facture->statut) == 'Partiellement payée' ? 'selected' : '' }}>Partiellement payée</option>
                                    <option value="Payée" {{ old('statut', $facture->statut) == 'Payée' ? 'selected' : '' }}>Payée</option>
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
            <a href="{{ route('factures.show', $facture->id) }}" class="btn-cancel">
                <i class="bi bi-x-circle"></i> Annuler
            </a>
            <button type="submit" form="editFactureForm" class="btn-save">
                <i class="bi bi-check2-circle"></i> Enregistrer les modifications
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sousTotal = document.getElementById('sous_total');
            const montantTva = document.getElementById('montant_tva');
            const montantTotal = document.getElementById('montant_total');
            const montantPaye = document.getElementById('montant_paye');
            const statutSelect = document.getElementById('statut');

            function updateCalculations() {
                const st = parseFloat(sousTotal.value) || 0;
                
                // Calculate 20% TVA
                const tva = st * 0.20;
                montantTva.value = tva.toFixed(2);
                
                // Calculate Total
                const total = st + tva;
                montantTotal.value = total.toFixed(2);

                updateStatus();
            }

            function calcTotal() {
                const st = parseFloat(sousTotal.value) || 0;
                const tva = parseFloat(montantTva.value) || 0;
                montantTotal.value = (st + tva).toFixed(2);
                updateStatus();
            }

            function updateStatus() {
                const total = parseFloat(montantTotal.value) || 0;
                const paye = parseFloat(montantPaye.value) || 0;

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

            if (sousTotal && montantTva && montantTotal && montantPaye && statutSelect) {
                sousTotal.addEventListener('input', updateCalculations);
                montantTva.addEventListener('input', calcTotal);
                montantPaye.addEventListener('input', updateStatus);
            }
        });
    </script>

@endsection