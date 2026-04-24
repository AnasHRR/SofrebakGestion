@extends('_layout')

@section('title', 'Modifier Commande')

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

        /* ── Alert ── */
        .alert-validation {
            background: #fff;
            border: 1.5px solid #fca5a5;
            border-radius: 14px;
            padding: 1rem 1.4rem;
            margin-bottom: 1.4rem;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.08);
            display: flex;
            gap: 0.85rem;
            align-items: flex-start;
        }

        .alert-validation-icon {
            width: 40px;
            height: 40px;
            background: #fef2f2;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #ef4444;
            font-size: 1.1rem;
        }

        .alert-validation h5 {
            font-size: 0.88rem;
            font-weight: 700;
            color: #991b1b;
            margin: 0 0 0.3rem;
        }

        .alert-validation ul {
            margin: 0;
            padding-left: 1rem;
        }

        .alert-validation ul li {
            font-size: 0.8rem;
            color: #b91c1c;
            font-weight: 500;
            line-height: 1.6;
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

        /* ── Section Dividers ── */
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

        /* ── Form Grid ── */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.2rem;
        }

        .form-row.four-cols {
            grid-template-columns: repeat(4, 1fr);
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

        /* ── Custom Inputs ── */
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

        .custom-input[readonly] {
            background: #f8fafc;
            color: #64748b;
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

        .custom-select.is-invalid {
            border-color: #fca5a5;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }

        .custom-textarea {
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
            resize: vertical;
            min-height: 90px;
        }

        .custom-textarea:focus {
            border-color: var(--blue-400);
            box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.15);
            background: #fafbff;
        }

        .custom-textarea::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .invalid-feedback {
            display: block;
            font-size: 0.76rem;
            color: #ef4444;
            font-weight: 600;
            margin-top: 0.3rem;
            padding-left: 0.2rem;
        }

        /* ── Products Table ── */
        .products-section {
            background: #fff;
            border: 1.5px solid #e2eaf8;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(15, 42, 110, 0.04);
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
        }

        .products-table thead th {
            background: linear-gradient(135deg, #f8fafc, #eff6ff);
            padding: 0.85rem 0.9rem;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--blue-700);
            border-bottom: 1.5px solid #e2eaf8;
            text-align: left;
            white-space: nowrap;
        }

        .products-table thead th:first-child {
            padding-left: 1.2rem;
        }

        .products-table thead th:last-child {
            padding-right: 1.2rem;
            text-align: center;
        }

        .products-table tbody tr {
            border-bottom: 1px solid #f0f4ff;
            transition: background 0.2s ease;
        }

        .products-table tbody tr:hover {
            background: #fafbff;
        }

        .products-table tbody tr:last-child {
            border-bottom: none;
        }

        .products-table tbody td {
            padding: 0.7rem 0.9rem;
            vertical-align: middle;
        }

        .products-table tbody td:first-child {
            padding-left: 1.2rem;
        }

        .products-table tbody td:last-child {
            padding-right: 1.2rem;
            text-align: center;
        }

        /* Table inline inputs */
        .table-input {
            width: 100%;
            padding: 0.5rem 0.7rem;
            border: 1.5px solid #e2eaf8;
            border-radius: 8px;
            font-size: 0.84rem;
            font-weight: 500;
            color: #1e293b;
            background: #f8fafc;
            outline: none;
            transition: all 0.25s ease;
            font-family: inherit;
        }

        .table-input:focus {
            border-color: var(--blue-400);
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.12);
            background: #fff;
        }

        .table-input[readonly] {
            background: #f0f4ff;
            color: #64748b;
            cursor: default;
        }

        .table-input.text-center {
            text-align: center;
        }

        .table-input.text-end {
            text-align: right;
        }

        .table-select {
            width: 100%;
            padding: 0.5rem 0.7rem;
            border: 1.5px solid #e2eaf8;
            border-radius: 8px;
            font-size: 0.84rem;
            font-weight: 500;
            color: #1e293b;
            background: #f8fafc;
            outline: none;
            transition: all 0.25s ease;
            font-family: inherit;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 16 16'%3E%3Cpath fill='%2364748b' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 8px center;
            padding-right: 2rem;
            min-width: 160px;
        }

        .table-select:focus {
            border-color: var(--blue-400);
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.12);
            background-color: #fff;
        }

        /* Total display in table */
        .total-display {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--blue-700);
            text-align: right;
            padding-right: 0.2rem;
        }

        /* Remove row btn */
        .btn-remove {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: 1.5px solid #fecaca;
            background: #fef2f2;
            color: #ef4444;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-remove:hover {
            background: #fca5a5;
            color: #fff;
            border-color: #fca5a5;
            transform: translateY(-1px);
        }

        .btn-remove:disabled {
            opacity: 0.35;
            cursor: not-allowed;
            transform: none;
        }

        /* Products footer total */
        .products-footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 1rem 1.2rem;
            background: linear-gradient(135deg, #f8fafc, #eff6ff);
            border-top: 1.5px solid #e2eaf8;
            gap: 0.8rem;
        }

        .products-footer-label {
            font-size: 0.9rem;
            font-weight: 700;
            color: #0f1e4a;
            letter-spacing: -0.2px;
        }

        .products-footer-value {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
            color: #fff;
            padding: 0.5rem 1.1rem;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 800;
            box-shadow: 0 4px 14px rgba(29, 78, 216, 0.3);
            letter-spacing: -0.3px;
        }

        .products-footer-value .currency {
            font-size: 0.78rem;
            font-weight: 600;
            opacity: 0.8;
        }

        /* Add product button */
        .btn-add-product {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.55rem 1.2rem;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 700;
            background: #eff6ff;
            color: var(--blue-600);
            border: 1.5px solid var(--blue-100);
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
            margin-top: 1rem;
        }

        .btn-add-product:hover {
            background: var(--blue-100);
            border-color: var(--blue-300);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.12);
        }

        .btn-add-product i {
            font-size: 0.95rem;
        }

        /* ── Card Footer ── */
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

        /* ── Mobile Product Cards ── */
        .product-cards-mobile {
            display: none;
        }

        .product-card-item {
            background: #fff;
            border: 1.5px solid #e2eaf8;
            border-radius: 14px;
            padding: 1rem;
            margin-bottom: 0.8rem;
            transition: box-shadow 0.2s ease;
        }

        .product-card-item:hover {
            box-shadow: 0 4px 14px rgba(15, 42, 110, 0.08);
        }

        .product-card-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.8rem;
            margin-top: 0.8rem;
        }

        .product-card-field label {
            display: block;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 0.3rem;
        }

        .product-card-field.full-width {
            grid-column: 1 / -1;
        }

        .product-card-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.8rem;
            padding-top: 0.8rem;
            border-top: 1px solid #f0f4ff;
        }

        .product-card-total-label {
            font-size: 0.78rem;
            font-weight: 700;
            color: #475569;
        }

        .product-card-total-value {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--blue-700);
        }

        .product-card-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 0.6rem;
        }

        /* ── Responsive ── */
        @media (max-width: 1024px) {
            .form-row.four-cols {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-row,
            .form-row.four-cols {
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

            /* Hide table, show cards on mobile */
            .products-table-wrapper {
                display: none;
            }

            .product-cards-mobile {
                display: block;
                padding: 0.8rem;
            }

            .products-footer {
                flex-direction: column;
                gap: 0.6rem;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .product-card-row {
                grid-template-columns: 1fr;
            }

            .form-header-title {
                font-size: 0.95rem;
            }

            .form-header-sub {
                font-size: 0.7rem;
            }
        }
    </style>

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h2><i class="bi bi-pencil-square me-2" style="color:var(--blue-500);"></i>Modifier la Commande</h2>
            <p>Mise à jour de la commande <strong>#{{ $commandeClient->numero_commande }}</strong></p>
        </div>
        <a href="{{ route('commandes.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Retour aux commandes
        </a>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert-validation">
            <div class="alert-validation-icon">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>
            <div>
                <h5>Des erreurs de validation ont été trouvées</h5>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Form Card -->
    <div class="form-card">
        <!-- Header -->
        <div class="form-card-header">
            <div class="form-header-icon">
                <i class="bi bi-bag-check"></i>
            </div>
            <div class="form-header-info">
                <div class="form-header-title">Commande #{{ $commandeClient->numero_commande }}</div>
                <div class="form-header-sub">Modifier les informations et les produits de la commande</div>
            </div>
        </div>

        <!-- Body -->
        <div class="form-card-body">
            <form action="{{ route('commandes.update', $commandeClient->id) }}" method="POST" id="editCommandeForm">
                @csrf
                @method('PUT')

                <!-- Section: Référence & Dates -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="bi bi-info-circle"></i> Informations Générales
                    </div>

                    <div class="form-row four-cols">
                        <!-- ID -->
                        <div class="form-group">
                            <label for="id">
                                <i class="bi bi-key"></i> ID
                            </label>
                            <div class="custom-input-wrapper">
                                <div class="custom-input-icon">
                                    <i class="bi bi-lock"></i>
                                </div>
                                <input type="text" class="custom-input" id="id" value="{{ $commandeClient->id }}" readonly
                                    disabled placeholder="ID">
                            </div>
                        </div>

                        <!-- Numéro Commande -->
                        <div class="form-group">
                            <label for="numero_commande">
                                <i class="bi bi-hash"></i> N° Commande <span class="required">*</span>
                            </label>
                            <div class="custom-input-wrapper">
                                <div class="custom-input-icon">
                                    <i class="bi bi-hash"></i>
                                </div>
                                <input type="text" class="custom-input @error('numero_commande') is-invalid @enderror"
                                    id="numero_commande" name="numero_commande"
                                    value="{{ old('numero_commande', $commandeClient->numero_commande) }}" required
                                    placeholder="Ex: CMD-2026-001">
                            </div>
                            @error('numero_commande')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date Commande -->
                        <div class="form-group">
                            <label for="date_commande">
                                <i class="bi bi-calendar-event"></i> Date Commande <span class="required">*</span>
                            </label>
                            <div class="custom-input-wrapper">
                                <div class="custom-input-icon">
                                    <i class="bi bi-calendar3"></i>
                                </div>
                                <input type="date" class="custom-input @error('date_commande') is-invalid @enderror"
                                    id="date_commande" name="date_commande"
                                    value="{{ old('date_commande', $commandeClient->date_commande ? \Carbon\Carbon::parse($commandeClient->date_commande)->format('Y-m-d') : '') }}"
                                    required>
                            </div>
                            @error('date_commande')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date Livraison -->
                        <div class="form-group">
                            <label for="date_livraison">
                                <i class="bi bi-calendar-check"></i> Date Livraison
                            </label>
                            <div class="custom-input-wrapper">
                                <div class="custom-input-icon">
                                    <i class="bi bi-truck"></i>
                                </div>
                                <input type="date" class="custom-input" id="date_livraison" name="date_livraison"
                                    value="{{ old('date_livraison', $commandeClient->date_livraison ? \Carbon\Carbon::parse($commandeClient->date_livraison)->format('Y-m-d') : '') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: Client & Comptable -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="bi bi-people"></i> Client & Responsable
                    </div>

                    <div class="form-row" style="grid-template-columns: repeat(3, 1fr);">
                        <!-- Client -->
                        <div class="form-group">
                            <label for="client_id">
                                <i class="bi bi-building"></i> Client <span class="required">*</span>
                            </label>
                            <div class="custom-input-wrapper">
                                <div class="custom-input-icon">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <select class="custom-select @error('client_id') is-invalid @enderror" id="client_id"
                                    name="client_id" required>
                                    <option value="" disabled>-- Sélectionnez un client --</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" {{ old('client_id', $commandeClient->client_id) == $client->id ? 'selected' : '' }}>
                                            {{ $client->nom_entreprise }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('client_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Comptable -->
                        <div class="form-group">
                            <label for="comptable_id">
                                <i class="bi bi-person-badge"></i> Comptable
                            </label>
                            <div class="custom-input-wrapper">
                                <div class="custom-input-icon">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <select class="custom-select" id="comptable_id" name="comptable_id">
                                    <option value="">-- Sélectionnez un comptable --</option>
                                    @foreach ($employes as $emp)
                                        <option value="{{ $emp->id }}" {{ old('comptable_id', $commandeClient->comptable_id) == $emp->id ? 'selected' : '' }}>
                                            {{ $emp->nom_complet }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Expedition -->
                        <div class="form-group">
                            <label for="expedition_id">
                                <i class="bi bi-truck"></i> Expédition
                            </label>
                            <div class="custom-input-wrapper">
                                <div class="custom-input-icon">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <select class="custom-select" id="expedition_id" name="expedition_id">
                                    <option value="">-- Non assignée --</option>
                                    @foreach ($expeditions as $exped)
                                        <option value="{{ $exped->id }}" {{ old('expedition_id', $commandeClient->expedition_id) == $exped->id ? 'selected' : '' }}>
                                            {{ $exped->employes->nom_complet ?? 'N/A' }} -
                                            {{ \Carbon\Carbon::parse($exped->date_expedition)->format('d/m/Y') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: Statut -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="bi bi-flag"></i> Statut
                    </div>

                    <div class="form-row">
                        <!-- Statut Commande -->
                        <div class="form-group">
                            <label for="statut">
                                <i class="bi bi-flag-fill"></i> Statut Commande
                            </label>
                            <div class="custom-input-wrapper">
                                <div class="custom-input-icon">
                                    <i class="bi bi-flag"></i>
                                </div>
                                <select class="custom-select" id="statut" name="statut">
                                    <option value="Nouvelle" {{ old('statut', $commandeClient->statut) == 'Nouvelle' ? 'selected' : '' }}>Nouvelle</option>
                                    <option value="En préparation" {{ old('statut', $commandeClient->statut) == 'En préparation' ? 'selected' : '' }}>En préparation</option>
                                    <option value="Expédiée" {{ old('statut', $commandeClient->statut) == 'Expédiée' ? 'selected' : '' }}>Expédiée</option>
                                    <option value="Livrée" {{ old('statut', $commandeClient->statut) == 'Livrée' ? 'selected' : '' }}>Livrée</option>
                                    <option value="Annulée" {{ old('statut', $commandeClient->statut) == 'Annulée' ? 'selected' : '' }}>Annulée</option>
                                </select>
                            </div>
                        </div>

                        <!-- Statut Paiement -->
                        <div class="form-group">
                            <label for="statut_paiement">
                                <i class="bi bi-wallet2"></i> Statut Paiement
                            </label>
                            <div class="custom-input-wrapper">
                                <div class="custom-input-icon">
                                    <i class="bi bi-credit-card"></i>
                                </div>
                                <select class="custom-select" id="statut_paiement" name="statut_paiement">
                                    <option value="Non payé" {{ old('statut_paiement', $commandeClient->statut_paiement) == 'Non payé' ? 'selected' : '' }}>Non payé</option>
                                    <option value="Partiellement payé" {{ old('statut_paiement', $commandeClient->statut_paiement) == 'Partiellement payé' ? 'selected' : '' }}>
                                        Partiellement payé</option>
                                    <option value="Payé" {{ old('statut_paiement', $commandeClient->statut_paiement) == 'Payé' ? 'selected' : '' }}>Payé</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: Produits -->
                <div class="form-section" style="margin-bottom: 0;">
                    <div class="form-section-title">
                        <i class="bi bi-box-seam"></i> Produits de la Commande
                    </div>

                    @php
                        $oldProduits = old('produits');
                        if (!$oldProduits && $commandeClient->details) {
                            $oldProduits = $commandeClient->details->toArray();
                        }
                        if (!$oldProduits || count($oldProduits) == 0) {
                            $oldProduits = [[]];
                        }
                    @endphp

                    <!-- Desktop Table -->
                    <div class="products-section">
                        <div class="products-table-wrapper">
                            <table class="products-table" id="produits-table">
                                <thead>
                                    <tr>
                                        <th style="min-width:200px;">Produit</th>
                                        <th style="width:110px;">Quantité</th>
                                        <th style="width:140px;">Prix Unit. (MAD)</th>
                                        <th style="width:110px;">Remise (%)</th>
                                        <th style="width:140px;">Total (MAD)</th>
                                        <th style="width:70px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($oldProduits as $index => $detail)
                                        @php
                                            $produit_id = $detail['produit_id'] ?? '';
                                            $quantite = $detail['quantite'] ?? 1;
                                            $prix_unitaire = $detail['prix_unitaire'] ?? '';
                                            $remise = $detail['remise'] ?? 0;
                                            $prix_total = is_numeric($prix_unitaire) ? max(0, ($quantite * $prix_unitaire) * (1 - $remise / 100)) : 0;
                                        @endphp
                                        <tr class="produit-row">
                                            <td>
                                                <select class="table-select produit-select"
                                                    name="produits[{{ $index }}][produit_id]" required>
                                                    <option value="" data-prix="0">Sélectionnez un produit...</option>
                                                    @foreach ($produits as $produit)
                                                        <option value="{{ $produit->id }}" data-prix="{{ $produit->prix_vente }}" {{ $produit_id == $produit->id ? 'selected' : '' }}>
                                                            {{ $produit->nom_produit }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="table-input text-center quantite-input"
                                                    name="produits[{{ $index }}][quantite]" min="1" value="{{ $quantite }}"
                                                    required>
                                            </td>
                                            <td>
                                                <input type="number" step="0.01"
                                                    class="table-input text-end prix-unitaire-input"
                                                    name="produits[{{ $index }}][prix_unitaire]" value="{{ $prix_unitaire }}"
                                                    required readonly>
                                            </td>
                                            <td>
                                                <input type="number" step="0.01" class="table-input text-center remise-input"
                                                    name="produits[{{ $index }}][remise]" min="0" value="{{ $remise }}">
                                            </td>
                                            <td>
                                                <div class="total-display prix-total-input">
                                                    {{ number_format($prix_total, 2, '.', '') }}</div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn-remove remove-row-btn" title="Supprimer" {{ count($oldProduits) <= 1 ? 'disabled' : '' }}>
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Cards -->
                        <div class="product-cards-mobile" id="product-cards-mobile">
                            @foreach($oldProduits as $index => $detail)
                                @php
                                    $produit_id = $detail['produit_id'] ?? '';
                                    $quantite = $detail['quantite'] ?? 1;
                                    $prix_unitaire = $detail['prix_unitaire'] ?? '';
                                    $remise = $detail['remise'] ?? 0;
                                    $prix_total = is_numeric($prix_unitaire) ? max(0, ($quantite * $prix_unitaire) * (1 - $remise / 100)) : 0;
                                @endphp
                                <div class="product-card-item produit-row-mobile">
                                    <div class="product-card-field full-width">
                                        <label>Produit</label>
                                        <select class="table-select produit-select-mobile"
                                            name="produits_mobile[{{ $index }}][produit_id]" required>
                                            <option value="" data-prix="0">Sélectionnez un produit...</option>
                                            @foreach ($produits as $produit)
                                                <option value="{{ $produit->id }}" data-prix="{{ $produit->prix_vente }}" {{ $produit_id == $produit->id ? 'selected' : '' }}>{{ $produit->nom_produit }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="product-card-row">
                                        <div class="product-card-field">
                                            <label>Quantité</label>
                                            <input type="number" class="table-input text-center quantite-input-mobile"
                                                name="produits_mobile[{{ $index }}][quantite]" min="1" value="{{ $quantite }}"
                                                required>
                                        </div>
                                        <div class="product-card-field">
                                            <label>Prix Unit. (MAD)</label>
                                            <input type="number" step="0.01"
                                                class="table-input text-end prix-unitaire-input-mobile"
                                                name="produits_mobile[{{ $index }}][prix_unitaire]" value="{{ $prix_unitaire }}"
                                                required readonly>
                                        </div>
                                        <div class="product-card-field">
                                            <label>Remise (%)</label>
                                            <input type="number" step="0.01" class="table-input text-center remise-input-mobile"
                                                name="produits_mobile[{{ $index }}][remise]" min="0" value="{{ $remise }}">
                                        </div>
                                        <div class="product-card-field">
                                            <label>Total (MAD)</label>
                                            <div class="total-display prix-total-input-mobile" style="padding: 0.5rem 0;">
                                                {{ number_format($prix_total, 2, '.', '') }}</div>
                                        </div>
                                    </div>
                                    <div class="product-card-actions">
                                        <button type="button" class="btn-remove remove-row-btn-mobile" title="Supprimer" {{ count($oldProduits) <= 1 ? 'disabled' : '' }}>
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Footer Total -->
                        <div class="products-footer">
                            <span class="products-footer-label">Montant Total Global :</span>
                            <div class="products-footer-value">
                                <span
                                    id="montant_total_display">{{ number_format(old('montant_total', $commandeClient->montant_total), 2, '.', '') }}</span>
                                <span class="currency">MAD</span>
                            </div>
                            <input type="hidden" id="montant_total" name="montant_total"
                                value="{{ number_format(old('montant_total', $commandeClient->montant_total), 2, '.', '') }}">
                        </div>
                    </div>

                    <button type="button" class="btn-add-product" id="add-row-btn">
                        <i class="bi bi-plus-circle-fill"></i> Ajouter un autre produit
                    </button>
                </div>

                <!-- Section: Notes -->
                <div class="form-section" style="margin-top: 1.6rem; margin-bottom: 0;">
                    <div class="form-section-title">
                        <i class="bi bi-chat-left-text"></i> Notes
                    </div>

                    <div class="form-group full-width">
                        <label for="notes">
                            <i class="bi bi-journal-text"></i> Notes Additionnelles
                        </label>
                        <div class="custom-input-wrapper">
                            <div class="custom-input-icon"
                                style="border-radius: 10px 0 0 10px; align-self: stretch; height: auto;">
                                <i class="bi bi-chat-dots"></i>
                            </div>
                            <textarea class="custom-textarea" id="notes" name="notes"
                                placeholder="Ajoutez des notes supplémentaires ici...">{{ old('notes', $commandeClient->notes) }}</textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="form-card-footer">
            <a href="{{ route('commandes.index') }}" class="btn-cancel">
                <i class="bi bi-x-circle"></i> Annuler
            </a>
            <button type="submit" form="editCommandeForm" class="btn-save">
                <i class="bi bi-check2-circle"></i> Mettre à jour la commande
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let rowIdx = document.querySelectorAll('.produit-row').length;
            const tableBody = document.querySelector('#produits-table tbody');
            const montantTotalInput = document.getElementById('montant_total');
            const montantTotalDisplay = document.getElementById('montant_total_display');
            const addRowBtn = document.getElementById('add-row-btn');

            function calculateTotals() {
                let globalTotal = 0;
                document.querySelectorAll('.produit-row').forEach(row => {
                    const quantiteInput = row.querySelector('.quantite-input');
                    const prixUnitaireInput = row.querySelector('.prix-unitaire-input');
                    const remiseInput = row.querySelector('.remise-input');
                    const prixTotalDisplay = row.querySelector('.prix-total-input');

                    const quantite = parseFloat(quantiteInput.value) || 0;
                    const prixUnitaire = parseFloat(prixUnitaireInput.value) || 0;
                    const remise = parseFloat(remiseInput.value) || 0;
                    const prixTotal = Math.max(0, (quantite * prixUnitaire) * (1 - remise / 100));

                    prixTotalDisplay.textContent = prixTotal.toFixed(2);
                    globalTotal += prixTotal;
                });
                montantTotalInput.value = globalTotal.toFixed(2);
                montantTotalDisplay.textContent = globalTotal.toFixed(2);
            }

            function updateRowListeners(row) {
                const produitSelect = row.querySelector('.produit-select');
                const quantiteInput = row.querySelector('.quantite-input');
                const prixUnitaireInput = row.querySelector('.prix-unitaire-input');
                const remiseInput = row.querySelector('.remise-input');
                const removeBtn = row.querySelector('.remove-row-btn');

                produitSelect.addEventListener('change', function () {
                    const selectedOption = this.options[this.selectedIndex];
                    const prix = selectedOption.getAttribute('data-prix');
                    if (prix !== null) {
                        prixUnitaireInput.value = parseFloat(prix).toFixed(2);
                    } else {
                        prixUnitaireInput.value = '';
                    }
                    calculateTotals();
                });

                quantiteInput.addEventListener('input', calculateTotals);
                prixUnitaireInput.addEventListener('input', calculateTotals);
                remiseInput.addEventListener('input', calculateTotals);

                if (removeBtn) {
                    removeBtn.addEventListener('click', function () {
                        if (document.querySelectorAll('.produit-row').length > 1) {
                            row.remove();
                            calculateTotals();
                            updateRemoveButtons();
                        }
                    });
                }
            }

            function updateRemoveButtons() {
                const rows = document.querySelectorAll('.produit-row');
                const removeBtns = document.querySelectorAll('.remove-row-btn');
                removeBtns.forEach(btn => {
                    btn.disabled = rows.length === 1;
                });
            }

            // Initialize existing row listeners
            document.querySelectorAll('.produit-row').forEach(row => {
                updateRowListeners(row);
            });

            addRowBtn.addEventListener('click', function () {
                const firstRow = tableBody.querySelector('.produit-row');
                const newRow = firstRow.cloneNode(true);

                // Reset inputs
                newRow.querySelectorAll('input').forEach(input => {
                    if (input.type !== 'button') {
                        if (input.classList.contains('quantite-input')) {
                            input.value = '1';
                        } else if (input.classList.contains('remise-input')) {
                            input.value = '0';
                        } else {
                            input.value = '';
                        }
                    }
                });

                // Reset total display
                const totalDisplay = newRow.querySelector('.prix-total-input');
                if (totalDisplay) {
                    totalDisplay.textContent = '0.00';
                }

                // Reset select
                const select = newRow.querySelector('.produit-select');
                select.selectedIndex = 0;

                // Update names with correct index
                select.name = `produits[${rowIdx}][produit_id]`;
                newRow.querySelector('.quantite-input').name = `produits[${rowIdx}][quantite]`;
                newRow.querySelector('.prix-unitaire-input').name = `produits[${rowIdx}][prix_unitaire]`;
                newRow.querySelector('.remise-input').name = `produits[${rowIdx}][remise]`;

                tableBody.appendChild(newRow);
                updateRowListeners(newRow);
                updateRemoveButtons();
                rowIdx++;
            });

            // Initial total calculation
            calculateTotals();
        });
    </script>

@endsection