@extends('_layout')

@section('title', 'Ajouter un Produit - Sofrebak')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-8">

            <!-- Header -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-1 fw-bold text-dark">
                        <i class="bi bi-box-seam-fill text-primary me-2"></i>Nouveau Produit
                    </h4>
                    <p class="text-muted small mb-0">Remplissez les informations ci-dessous pour ajouter un produit au catalogue.</p>
                </div>
                <a href="{{ route('produits.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Retour à la liste
                </a>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">

                            <!-- Informations Générales -->
                            <div class="col-12">
                                <h6 class="text-primary text-uppercase fw-bold small mb-3 border-bottom pb-2">
                                    <i class="bi bi-info-circle me-2"></i>Informations Générales
                                </h6>
                            </div>

                            <!-- Image du Produit -->
                            <div class="col-12">
                                <label for="img_pr" class="form-label fw-semibold">Image du Produit</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-image"></i>
                                    </span>
                                    <input type="file" name="img_pr" id="img_pr" 
                                        class="form-control border-start-0 @error('img_pr') is-invalid @enderror" 
                                        accept="image/*">
                                </div>
                                @error('img_pr')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nom du Produit -->
                            <div class="col-12">
                                <label for="nom_produit" class="form-label fw-semibold">Nom du Produit</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-tag"></i>
                                    </span>
                                    <input type="text" name="nom_produit" id="nom_produit" 
                                        class="form-control border-start-0" 
                                        placeholder="Ex: Palette Europe, Support Métallique..." 
                                        required>
                                </div>
                            </div>

                            <!-- Catégorie -->
                            <div class="col-md-6">
                                <label for="categorie_id" class="form-label fw-semibold">Catégorie</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-list-ul"></i>
                                    </span>
                                    <select name="categorie_id" id="categorie_id" class="form-select border-start-0" required>
                                        <option value="" selected disabled>Choisir une catégorie...</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Fournisseur -->
                            <div class="col-md-6">
                                <label for="fournisseur_id" class="form-label fw-semibold">Fournisseur</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-truck"></i>
                                    </span>
                                    <select name="fournisseur_id" id="fournisseur_id" class="form-select border-start-0" required>
                                        <option value="" selected disabled>Choisir un fournisseur...</option>
                                        @foreach ($fournisseurs as $f)
                                            <option value="{{ $f->id }}">{{ $f->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Unité -->
                            <div class="col-md-6">
                                <label for="unite" class="form-label fw-semibold">Unité</label>
                                <input type="text" name="unite" id="unite" class="form-control" placeholder="Ex: pcs, kg..." required>
                            </div>

                            <!-- Prix Achat -->
                            <div class="col-md-6">
                                <label for="prix_achat" class="form-label fw-semibold">Prix d'Achat (DH)</label>
                                <input type="number" step="0.01" name="prix_achat" id="prix_achat" class="form-control" placeholder="0.00" required>
                            </div>

                            <!-- Prix Vente -->
                            <div class="col-md-6">
                                <label for="prix_vente" class="form-label fw-semibold">Prix de Vente (DH)</label>
                                <input type="number" step="0.01" name="prix_vente" id="prix_vente" class="form-control" placeholder="0.00" required>
                            </div>

                            <!-- Stock Minimum -->
                            <div class="col-md-6">
                                <label for="stock_minimum" class="form-label fw-semibold">Stock Minimum</label>
                                <input type="number" name="stock_minimum" id="stock_minimum" class="form-control" placeholder="Quantité minimale" required>
                            </div>

                            <!-- Stock Initial -->
                            <div class="col-md-6">
                                <label for="stock_initial" class="form-label fw-semibold">Stock Initial</label>
                                <input type="number" name="stock_initial" id="stock_initial" class="form-control" placeholder="Quantité initiale" required>
                            </div>

                            <!-- Date d'Expiration -->
                            <div class="col-md-6">
                                <label for="date_expiration" class="form-label fw-semibold">Date d'Expiration</label>
                                <input type="date" name="date_expiration" id="date_expiration" class="form-control" required>
                            </div>

                            <!-- Buttons -->
                            <div class="col-12 mt-5">
                                <hr class="my-4 opacity-10">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="reset" class="btn btn-light px-4 fw-semibold text-muted">
                                        Réinitialiser
                                    </button>
                                    <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                                        <i class="bi bi-plus-circle me-2"></i>Ajouter le Produit
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Help -->
            <div class="mt-4 p-3 bg-white border border-info border-start-4 rounded shadow-sm">
                <div class="d-flex">
                    <i class="bi bi-info-circle-fill text-info me-3 h4 mb-0"></i>
                    <div>
                        <p class="mb-0 small text-dark"><strong>Note:</strong> Assurez-vous que les catégories et fournisseurs ont déjà été créés avant d'ajouter de nouveaux produits.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .border-start-4 {
        border-left-width: 4px !important;
    }
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
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
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