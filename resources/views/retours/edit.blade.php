@extends('_layout')

@section('title', 'Modifier Retour - Sofrebak')

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
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background: #f8fafc;
        color: var(--blue-600);
        border-color: var(--blue-200);
    }

    /* ── Form Card ── */
    .form-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        padding: 2rem;
    }

    .form-label {
        font-size: 0.82rem;
        font-weight: 700;
        color: #475569;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control, .form-select {
        border: 1.5px solid #e2eaf8;
        border-radius: 10px;
        padding: 0.65rem 1rem;
        font-size: 0.88rem;
        transition: all 0.2s;
        background-color: #fbfcfe;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--blue-400);
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        outline: none;
    }

    .input-group-text {
        background: #f1f5f9;
        border: 1.5px solid #e2eaf8;
        border-right: none;
        border-radius: 10px 0 0 10px;
        color: #64748b;
    }

    .input-group .form-control, .input-group .form-select {
        border-radius: 0 10px 10px 0;
    }

    .section-title {
        font-size: 0.75rem;
        font-weight: 800;
        color: var(--blue-600);
        text-transform: uppercase;
        letter-spacing: 1.2px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, #e2eaf8, transparent);
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
        color: #fff;
        font-weight: 700;
        padding: 0.7rem 2rem;
        border-radius: 10px;
        border: none;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(29, 78, 216, 0.25);
    }

    .btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(29, 78, 216, 0.35);
        color: #fff;
    }
</style>

<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-pencil-fill me-2" style="color:var(--blue-500);"></i>Modifier Retour #{{ $retour->id }}</h2>
        <p>Mise à jour des informations du retour</p>
    </div>
    <a href="{{ route('retours.index') }}" class="btn-back">
        <i class="bi bi-arrow-left me-1"></i> Retour à la liste
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="form-card">
            <form action="{{ route('retours.update', $retour->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    <!-- Informations Commande -->
                    <div class="col-12">
                        <div class="section-title">
                            <i class="bi bi-receipt"></i> Détails de la Commande
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Commande Client</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-hash"></i></span>
                            <select name="commande_client_id" class="form-select @error('commande_client_id') is-invalid @enderror" required>
                                @foreach($commandes as $cmd)
                                    <option value="{{ $cmd->id }}" {{ $retour->commande_client_id == $cmd->id ? 'selected' : '' }}>
                                        Commande {{ $cmd->numero_commande ?? '#'.$cmd->id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('commande_client_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Produit</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-box"></i></span>
                            <select name="produit_id" class="form-select @error('produit_id') is-invalid @enderror" required>
                                @foreach($produits as $prod)
                                    <option value="{{ $prod->id }}" {{ $retour->produit_id == $prod->id ? 'selected' : '' }}>
                                        {{ $prod->nom_produit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('produit_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Quantité</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-123"></i></span>
                            <input type="number" name="quantite" class="form-control @error('quantite') is-invalid @enderror" value="{{ $retour->quantite }}" min="1" required>
                        </div>
                        @error('quantite') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date de Retour</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                            <input type="date" name="date_retour" class="form-control @error('date_retour') is-invalid @enderror" value="{{ $retour->date_retour }}" required>
                        </div>
                        @error('date_retour') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <!-- Logistique & Motif -->
                    <div class="col-12 mt-5">
                        <div class="section-title">
                            <i class="bi bi-truck"></i> Logistique & Motif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Responsable (Comptable)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <select name="comptable_id" class="form-select @error('comptable_id') is-invalid @enderror" required>
                                @foreach($employes as $emp)
                                    <option value="{{ $emp->id }}" {{ $retour->comptable_id == $emp->id ? 'selected' : '' }}>
                                        {{ $emp->nom_complet }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('comptable_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Région</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <select name="region_id" class="form-select @error('region_id') is-invalid @enderror" required>
                                @foreach($regions as $reg)
                                    <option value="{{ $reg->id }}" {{ $retour->region_id == $reg->id ? 'selected' : '' }}>
                                        {{ $reg->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('region_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Motif du retour</label>
                        <textarea name="motif" class="form-control @error('motif') is-invalid @enderror" rows="3" required>{{ $retour->motif }}</textarea>
                        @error('motif') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Notes internes</label>
                        <textarea name="notes" class="form-control" rows="2">{{ $retour->notes }}</textarea>
                    </div>

                    <div class="col-12 mt-4 text-end">
                        <a href="{{ route('retours.index') }}" class="btn btn-light me-2 fw-bold px-4 border">Annuler</a>
                        <button type="submit" class="btn btn-submit">
                            <i class="bi bi-save me-1"></i> Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
