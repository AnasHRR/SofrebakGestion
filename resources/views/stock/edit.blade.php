@extends('_layout')

@section('title', 'Modifier un Mouvement de Stock')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-8">

            <!-- Header -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-1 fw-bold text-dark">
                        <i class="bi bi-pencil-square text-primary me-2"></i>Modifier le Mouvement
                    </h4>
                    <p class="text-muted small mb-0">Mettez à jour les informations du mouvement de stock.</p>
                </div>
                <a href="{{ route('stock.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Retour à la liste
                </a>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('stock.update', $stock->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">

                            <!-- Informations du Mouvement -->
                            <div class="col-12">
                                <h6 class="text-primary text-uppercase fw-bold small mb-3 border-bottom pb-2">
                                    <i class="bi bi-info-circle me-2"></i>Détails du Mouvement
                                </h6>
                            </div>

                            <!-- Produit -->
                            <div class="col-md-12">
                                <label for="produit_id" class="form-label fw-semibold">Produit</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-box-seam"></i>
                                    </span>
                                    <select name="produit_id" id="produit_id" class="form-select border-start-0" required>
                                        <option value="" disabled>Choisir un produit...</option>
                                        @foreach ($produits as $produit)
                                            <option value="{{ $produit->id }}" {{ $stock->produit_id == $produit->id ? 'selected' : '' }}>
                                                {{ $produit->nom_produit }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Type de Mouvement -->
                            <div class="col-md-6">
                                <label for="type_mouvement" class="form-label fw-semibold">Type de Mouvement</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-arrow-left-right"></i>
                                    </span>
                                    <select name="type_mouvement" id="type_mouvement" class="form-select border-start-0" required>
                                        <option value="Entrée" {{ $stock->type_mouvement == 'Entrée' ? 'selected' : '' }}>Entrée (Ajout)</option>
                                        <option value="Sortie" {{ $stock->type_mouvement == 'Sortie' ? 'selected' : '' }}>Sortie (Retrait)</option>
                                        <option value="Ajustement" {{ $stock->type_mouvement == 'Ajustement' ? 'selected' : '' }}>Ajustement</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Quantité -->
                            <div class="col-md-6">
                                <label for="quantite" class="form-label fw-semibold">Quantité</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-123"></i>
                                    </span>
                                    <input type="number" name="quantite" id="quantite" class="form-control border-start-0" value="{{ $stock->quantite }}" min="1" required>
                                </div>
                            </div>

                            <!-- Date du Mouvement -->
                            <div class="col-md-6">
                                <label for="date_mouvement" class="form-label fw-semibold">Date du Mouvement</label>
                                <input type="date" name="date_mouvement" id="date_mouvement" class="form-control" value="{{ $stock->date_mouvement }}" required>
                            </div>

                            <!-- Référence -->
                            <div class="col-md-6">
                                <label for="reference_id" class="form-label fw-semibold">Référence Externe (Optionel)</label>
                                <input type="text" name="reference_id" id="reference_id" class="form-control" value="{{ $stock->reference_id }}">
                            </div>

                            <!-- Notes -->
                            <div class="col-12">
                                <label for="notes" class="form-label fw-semibold">Notes & Observations</label>
                                <textarea name="notes" id="notes" class="form-control" rows="3">{{ $stock->notes }}</textarea>
                            </div>

                            <!-- Buttons -->
                            <div class="col-12 mt-5">
                                <hr class="my-4 opacity-10">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                                        <i class="bi bi-save me-2"></i>Sauvegarder les modifications
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus, .form-select:focus {
        border-color: #6384ff;
        box-shadow: 0 0 0 0.25rem rgba(99, 132, 255, 0.1);
    }
    .input-group-text {
        transition: all 0.2s ease;
    }
    .input-group:focus-within .input-group-text {
        color: #6384ff !important;
        background-color: #fff !important;
        border-color: #6384ff !important;
    }
    .btn-primary {
        background: linear-gradient(45deg, #1a1d2e, #4a5d99);
        border: none;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(99, 132, 255, 0.3);
    }
</style>
@endsection
