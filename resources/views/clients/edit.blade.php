@extends('_layout')

@section('title', 'Modifier le client ' . $client->personne_contact)

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
        top: -40px;
        right: -40px;
        width: 160px;
        height: 160px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }

    .form-card-header::after {
        content: '';
        position: absolute;
        bottom: -60px;
        left: -30px;
        width: 120px;
        height: 120px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
    }

    .form-header-icon {
        width: 48px;
        height: 48px;
        background: rgba(255,255,255,0.15);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 2px solid rgba(255,255,255,0.2);
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
        color: rgba(255,255,255,0.6);
        font-weight: 500;
        margin-top: 3px;
    }

    /* Card Body */
    .form-card-body {
        padding: 1.8rem;
    }

    /* Form Groups */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.2rem;
    }

    .form-group {
        margin-bottom: 1.2rem;
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

    .custom-textarea {
        width: 100%;
        padding: 0.65rem 0.9rem;
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
        min-height: 80px;
    }

    .custom-textarea:focus {
        border-color: var(--blue-400);
        box-shadow: 0 0 0 4px rgba(96,165,250,0.15);
        background: #fafbff;
    }

    .invalid-feedback {
        display: block;
        font-size: 0.76rem;
        color: #ef4444;
        font-weight: 600;
        margin-top: 0.3rem;
        padding-left: 0.2rem;
    }

    /* Credit Input */
    .credit-input-wrapper {
        display: flex;
        align-items: stretch;
    }

    .credit-input-wrapper .custom-input {
        border-radius: 10px 0 0 10px;
    }

    .credit-suffix {
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
            gap: 1rem;
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
        <h2><i class="bi bi-pencil-square me-2" style="color:var(--blue-500);"></i>Modifier le Client</h2>
        <p>Mise à jour des informations de <strong>{{ $client->personne_contact }}</strong></p>
    </div>
    <a href="{{ route('clients.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Retour à la liste
    </a>
</div>

<!-- Form Card -->
<div class="form-card">

    <!-- Header -->
    <div class="form-card-header">
        <div class="form-header-icon">
            <i class="bi bi-person-gear"></i>
        </div>
        <div class="form-header-info">
            <div class="form-header-title">{{ $client->personne_contact }}</div>
            <div class="form-header-sub">Modifier les informations du client</div>
        </div>
    </div>

    <!-- Body -->
    <div class="form-card-body">
        <form action="{{ route('clients.update', $client->id) }}" method="POST" id="editClientForm">
            @csrf
            @method('PUT')

            <div class="form-row">
                <!-- Nom du contact -->
                <div class="form-group">
                    <label for="personne_contact">
                        <i class="bi bi-person-fill"></i> Nom du Contact <span class="required">*</span>
                    </label>
                    <div class="custom-input-wrapper">
                        <div class="custom-input-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        <input type="text" id="personne_contact" name="personne_contact"
                            class="custom-input @error('personne_contact') is-invalid @enderror"
                            value="{{ old('personne_contact', $client->personne_contact) }}"
                            placeholder="Nom complet du contact" required>
                    </div>
                    @error('personne_contact')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Entreprise -->
                <div class="form-group">
                    <label for="nom_entreprise">
                        <i class="bi bi-building"></i> Entreprise <span class="required">*</span>
                    </label>
                    <div class="custom-input-wrapper">
                        <div class="custom-input-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <input type="text" id="nom_entreprise" name="nom_entreprise"
                            class="custom-input"
                            value="{{ old('nom_entreprise', $client->nom_entreprise) }}"
                            placeholder="Raison sociale" required>
                    </div>
                </div>

                <!-- Téléphone -->
                <div class="form-group">
                    <label for="telephone">
                        <i class="bi bi-telephone-fill"></i> Téléphone <span class="required">*</span>
                    </label>
                    <div class="custom-input-wrapper">
                        <div class="custom-input-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <input type="text" id="telephone" name="telephone" maxlength="14"
                            class="custom-input"
                            value="{{ old('telephone', $client->telephone) }}"
                            placeholder="+212 6123456789" required>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">
                        <i class="bi bi-envelope-fill"></i> Email
                    </label>
                    <div class="custom-input-wrapper">
                        <div class="custom-input-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <input type="email" id="email" name="email"
                            class="custom-input @error('email') is-invalid @enderror"
                            value="{{ old('email', $client->email) }}"
                            placeholder="client@example.com">
                    </div>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Région -->
                <div class="form-group">
                    <label for="region_id">
                        <i class="bi bi-geo-alt-fill"></i> Région <span class="required">*</span>
                    </label>
                    <div class="custom-input-wrapper">
                        <div class="custom-input-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <select name="region_id" id="region_id" class="custom-select" required>
                            <option value="">-- Choisir une région --</option>
                            @foreach ($region as $rg)
                                <option value="{{ $rg->id }}" {{ old('region_id', $client->region_id) == $rg->id ? 'selected' : '' }}>
                                    {{ $rg->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- 
                <!-- Plafond Crédit (uncomment if needed) -->
                <div class="form-group">
                    <label for="plafond_credit">
                        <i class="bi bi-cash-stack"></i> Plafond de Crédit
                    </label>
                    <div class="custom-input-wrapper">
                        <div class="custom-input-icon">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="credit-input-wrapper" style="flex:1;">
                            <input type="number" step="0.01" id="plafond_credit" name="plafond_credit"
                                class="custom-input"
                                value="{{ old('plafond_credit', $client->plafond_credit) }}"
                                placeholder="0.00">
                            <span class="credit-suffix">DH</span>
                        </div>
                    </div>
                </div>
                --}}

                <!-- Adresse -->
                <div class="form-group full-width">
                    <label for="adresse">
                        <i class="bi bi-pin-map-fill"></i> Adresse <span class="required">*</span>
                    </label>
                    <textarea id="adresse" name="adresse" class="custom-textarea" rows="3"
                        placeholder="Ex: 134 lots bassma Massira Fès..." required>{{ old('adresse', $client->adresse) }}</textarea>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <div class="form-card-footer">
        <a href="{{ route('clients.index') }}" class="btn-cancel">
            <i class="bi bi-x-circle"></i> Annuler
        </a>
        <button type="submit" form="editClientForm" class="btn-save">
            <i class="bi bi-check2-circle"></i> Enregistrer les modifications
        </button>
    </div>

</div>
@endsection