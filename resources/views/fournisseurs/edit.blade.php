@extends('_layout')
@section('title', 'Modifier le fournisseur')
@section('content')

<style>
    .form-card {
        background: #fff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        max-width: 720px;
        margin: 0 auto;
        overflow: hidden;
    }

    .form-card-header {
        background: linear-gradient(135deg, var(--blue-700), var(--blue-900));
        padding: 1.3rem 1.8rem;
        display: flex;
        align-items: center;
        gap: 0.9rem;
    }

    .form-card-header i { color: #fff; font-size: 1.5rem; }

    .form-card-header h4 {
        color: #fff;
        font-size: 1.1rem;
        font-weight: 800;
        margin: 0;
    }

    .form-card-header p {
        color: rgba(255,255,255,0.7);
        font-size: 0.78rem;
        margin: 0;
    }

    .form-card-body { padding: 1.8rem; }

    .form-group { margin-bottom: 1.2rem; }

    .form-group label {
        display: block;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        color: #64748b;
        margin-bottom: 0.4rem;
    }

    .form-group .required-star { color: #ef4444; margin-left: 2px; }

    .form-control-custom {
        width: 100%;
        padding: 0.65rem 1rem;
        border: 1.5px solid #e2eaf8;
        border-radius: 10px;
        font-size: 0.88rem;
        color: #1e293b;
        background: #f8faff;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: var(--blue-500);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
        background: #fff;
    }

    .form-control-custom.is-invalid {
        border-color: #ef4444;
        background: #fff5f5;
    }

    .form-control-custom:disabled {
        background: #f1f5fb;
        color: #94a3b8;
        cursor: not-allowed;
    }

    .invalid-feedback {
        display: block;
        color: #ef4444;
        font-size: 0.78rem;
        margin-top: 0.3rem;
        font-weight: 500;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-actions {
        display: flex;
        gap: 0.8rem;
        justify-content: flex-end;
        padding-top: 1.2rem;
        border-top: 1px solid #f1f5fb;
        margin-top: 0.5rem;
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.6rem 1.3rem;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        border: 1.5px solid #e2eaf8;
        background: #fff;
        color: #64748b;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-cancel:hover { background: #f8faff; color: #1e293b; }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
        color: #fff;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(29,78,216,0.3);
        transition: all 0.2s;
    }

    .btn-submit:hover {
        box-shadow: 0 6px 20px rgba(29,78,216,0.45);
        transform: translateY(-1px);
    }

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.6rem;
    }

    .page-header h2 {
        font-size: 1.35rem;
        font-weight: 800;
        color: #0f1e4a;
        margin: 0;
    }

    .page-header p {
        font-size: 0.82rem;
        color: #64748b;
        margin: 0.2rem 0 0;
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div>
        <h2><i class="bi bi-pencil-square me-2" style="color:var(--blue-500);"></i>Modifier le Fournisseur</h2>
        <p>Modifiez les informations du fournisseur <strong>{{ $fournisseur->nom }}</strong></p>
    </div>
    <a href="{{ route('fournisseurs.index') }}" class="btn-cancel">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="form-card">
    <div class="form-card-header">
        <i class="bi bi-building"></i>
        <div>
            <h4>Modifier les informations</h4>
            <p>Tous les champs marqués * sont obligatoires</p>
        </div>
    </div>

    <div class="form-card-body">
        <form action="{{ route('fournisseurs.update', $fournisseur->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir enregistrer les modifications ?');">
            @csrf
            @method('PUT')

            <div class="form-row">
                <!-- ID (read-only) -->
                <div class="form-group">
                    <label>Code Fournisseur</label>
                    <input type="text" value="{{ $fournisseur->id }}"
                           class="form-control-custom" disabled>
                </div>

                <!-- Nom -->
                <div class="form-group">
                    <label>Nom / Raison sociale <span class="required-star">*</span></label>
                    <input type="text" name="nom" value="{{ old('nom', $fournisseur->nom) }}"
                           class="form-control-custom @error('nom') is-invalid @enderror"
                           placeholder="Nom du fournisseur">
                    @error('nom')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Personne de contact -->
            <div class="form-group">
                <label>Personne de contact</label>
                <input type="text" name="personne_contact"
                       value="{{ old('personne_contact', $fournisseur->personne_contact) }}"
                       class="form-control-custom"
                       placeholder="Nom et prénom du contact">
            </div>

            <div class="form-row">
                <!-- Téléphone -->
                <div class="form-group">
                    <label>Téléphone</label>
                    <input type="text" name="telephone"
                           value="{{ old('telephone', $fournisseur->telephone) }}"
                           class="form-control-custom"
                           placeholder="Ex: 0600000000">
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email"
                           value="{{ old('email', $fournisseur->email) }}"
                           class="form-control-custom"
                           placeholder="contact@fournisseur.com">
                </div>
            </div>

            <!-- Adresse -->
            <div class="form-group">
                <label>Adresse</label>
                <input type="text" name="adresse"
                       value="{{ old('adresse', $fournisseur->adresse) }}"
                       class="form-control-custom"
                       placeholder="Adresse complète">
            </div>

            <!-- Conditions de paiement -->
            <div class="form-group">
                <label>Conditions de paiement</label>
                <input type="text" name="conditions_paiement"
                       value="{{ old('conditions_paiement', $fournisseur->conditions_paiement) }}"
                       class="form-control-custom"
                       placeholder="Ex: 30 jours net, virement...">
            </div>

            <div class="form-actions">
                <a href="{{ route('fournisseurs.index') }}" class="btn-cancel">
                    <i class="bi bi-x-lg"></i> Annuler
                </a>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-lg"></i> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
