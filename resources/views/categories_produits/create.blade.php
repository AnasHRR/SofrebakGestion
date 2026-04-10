@extends('_layout')
@section('title', 'Ajouter une catégorie')
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
        <h2><i class="bi bi-tags me-2" style="color:var(--blue-500);"></i>Nouvelle Catégorie</h2>
        <p>Remplissez le formulaire pour ajouter une catégorie de produits</p>
    </div>
    <a href="{{ route('categories.index') }}" class="btn-cancel">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="form-card">
    <div class="form-card-header">
        <i class="bi bi-box-seam"></i>
        <div>
            <h4>Informations de la catégorie</h4>
            <p>Tous les champs marqués * sont obligatoires</p>
        </div>
    </div>

    <div class="form-card-body">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <!-- ID -->
                <div class="form-group">
                    <label>Code Catégorie <span class="required-star">*</span></label>
                    <input type="text" name="id" value="{{ old('id') }}"
                           class="form-control-custom @error('id') is-invalid @enderror"
                           placeholder="Ex: CAT001" readonly disabled>
                    @error('id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nom -->
                <div class="form-group">
                    <label>Nom <span class="required-star">*</span></label>
                    <input type="text" name="nom" value="{{ old('nom') }}"
                           class="form-control-custom @error('nom') is-invalid @enderror"
                           placeholder="Nom de la catégorie">
                    @error('nom')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label>Description <span class="required-star">*</span></label>
                <textarea name="description" class="form-control-custom @error('description') is-invalid @enderror" 
                          rows="4" placeholder="Description de la catégorie">{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('categories.index') }}" class="btn-cancel">
                    <i class="bi bi-x-lg"></i> Annuler
                </a>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-lg"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

@endsection