@extends('_layout')

@section('title', 'Modifier Commande')

@section('content')
<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-primary mb-0 fw-bold">Modifier Commande #{{ $commandeClient->numero_commande }}</h1>
            <p class="text-muted mb-0">Mise à jour des informations de la commande</p>
        </div>
        <a href="{{ route('commandes.index') }}" class="btn btn-outline-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-arrow-left me-2"></i>Retour aux Commandes
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-4 shadow-sm border-0 mb-4">
            <div class="d-flex align-items-center mb-2">
                <i class="bi bi-exclamation-triangle-fill fs-4 me-2"></i>
                <h5 class="mb-0">Des erreurs de validation ont été trouvées</h5>
            </div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-primary bg-gradient text-white py-3">
            <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Détails de la Commande</h5>
        </div>
        <div class="card-body p-4 bg-light bg-opacity-50">
            <form action="{{ route('commandes.update', $commandeClient->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-4 mb-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="id" value="{{ $commandeClient->id }}" readonly disabled placeholder="ID">
                            <label for="id">ID (Non modifiable)</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('numero_commande') is-invalid @enderror" id="numero_commande" name="numero_commande" value="{{ old('numero_commande', $commandeClient->numero_commande) }}" required placeholder="Numéro">
                            <label for="numero_commande">Numéro Commande <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('date_commande') is-invalid @enderror" id="date_commande" name="date_commande" value="{{ old('date_commande', $commandeClient->date_commande ? \Carbon\Carbon::parse($commandeClient->date_commande)->format('Y-m-d') : '') }}" required>
                            <label for="date_commande">Date Commande <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="date_livraison" name="date_livraison" value="{{ old('date_livraison', $commandeClient->date_livraison ? \Carbon\Carbon::parse($commandeClient->date_livraison)->format('Y-m-d') : '') }}">
                            <label for="date_livraison">Date Livraison</label>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select @error('client_id') is-invalid @enderror" id="client_id" name="client_id" required>
                                <option value="">Sélectionnez un client</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $commandeClient->client_id) == $client->id ? 'selected' : '' }}>
                                        {{ $client->nom_entreprise }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="client_id">Client <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="comptable_id" name="comptable_id">
                                <option value="">Sélectionnez un comptable</option>
                                @foreach ($employes as $emp)
                                    <option value="{{ $emp->id }}" {{ old('comptable_id', $commandeClient->comptable_id) == $emp->id ? 'selected' : '' }}>
                                        {{ $emp->nom_complet }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="comptable_id">Comptable</label>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="statut" name="statut">
                                <option value="Nouvelle" {{ old('statut', $commandeClient->statut) == 'Nouvelle' ? 'selected' : '' }}>Nouvelle</option>
                                <option value="En préparation" {{ old('statut', $commandeClient->statut) == 'En préparation' ? 'selected' : '' }}>En préparation</option>
                                <option value="Expédiée" {{ old('statut', $commandeClient->statut) == 'Expédiée' ? 'selected' : '' }}>Expédiée</option>
                                <option value="Livrée" {{ old('statut', $commandeClient->statut) == 'Livrée' ? 'selected' : '' }}>Livrée</option>
                                <option value="Annulée" {{ old('statut', $commandeClient->statut) == 'Annulée' ? 'selected' : '' }}>Annulée</option>
                            </select>
                            <label for="statut">Statut de la commande</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="statut_paiement" name="statut_paiement">
                                <option value="Non payé" {{ old('statut_paiement', $commandeClient->statut_paiement) == 'Non payé' ? 'selected' : '' }}>Non payé</option>
                                <option value="Partiellement payé" {{ old('statut_paiement', $commandeClient->statut_paiement) == 'Partiellement payé' ? 'selected' : '' }}>Partiellement payé</option>
                                <option value="Payé" {{ old('statut_paiement', $commandeClient->statut_paiement) == 'Payé' ? 'selected' : '' }}>Payé</option>
                            </select>
                            <label for="statut_paiement">Statut Paiement</label>
                        </div>
                    </div>
                </div>

                <hr class="my-5 border-primary border-opacity-25">
                
                <h5 class="text-primary fw-bold mb-4"><i class="bi bi-box-seam me-2"></i>Produits de la commande</h5>
                
                <div class="table-responsive rounded-4 shadow-sm mb-4 bg-white">
                    <table class="table table-hover align-middle mb-0" id="produits-table">
                        <thead class="table-light">
                            <tr>
                                <th class="text-primary fw-semibold border-0 py-3 ps-4">Produit</th>
                                <th class="text-primary fw-semibold border-0 py-3" style="width: 130px;">Quantité</th>
                                <th class="text-primary fw-semibold border-0 py-3" style="width: 150px;">Prix Unit. (MAD)</th>
                                <th class="text-primary fw-semibold border-0 py-3" style="width: 130px;">Remise (%)</th>
                                <th class="text-primary fw-semibold border-0 py-3" style="width: 150px;">Total (MAD)</th>
                                <th class="text-primary fw-semibold border-0 py-3 text-center pe-4" style="width: 80px;">Action</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @php
                                $oldProduits = old('produits');
                                if (!$oldProduits && $commandeClient->details) {
                                    $oldProduits = $commandeClient->details->toArray();
                                }
                                if (!$oldProduits || count($oldProduits) == 0) {
                                    $oldProduits = [[]]; // Start with one empty row if none
                                }
                            @endphp
                            
                            @foreach($oldProduits as $index => $detail)
                                @php
                                    $produit_id = $detail['produit_id'] ?? '';
                                    $quantite = $detail['quantite'] ?? 1;
                                    $prix_unitaire = $detail['prix_unitaire'] ?? '';
                                    $remise = $detail['remise'] ?? 0;
                                    $prix_total = is_numeric($prix_unitaire) ? max(0, ($quantite * $prix_unitaire) * (1 - $remise / 100)) : 0;
                                @endphp
                                <tr class="produit-row py-2">
                                    <td class="ps-4">
                                        <select class="form-select border-0 bg-light produit-select" name="produits[{{ $index }}][produit_id]" required>
                                            <option value="" data-prix="0">Sélectionnez un produit...</option>
                                            @foreach ($produits as $produit)
                                                <option value="{{ $produit->id }}" data-prix="{{ $produit->prix_vente }}" {{ $produit_id == $produit->id ? 'selected' : '' }}>{{ $produit->nom_produit }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control border-0 bg-light quantite-input text-center" name="produits[{{ $index }}][quantite]" min="1" value="{{ $quantite }}" required>
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" class="form-control border-0 bg-light prix-unitaire-input text-end" name="produits[{{ $index }}][prix_unitaire]" value="{{ $prix_unitaire }}" required readonly>
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" class="form-control border-0 bg-light remise-input text-center" name="produits[{{ $index }}][remise]" min="0" value="{{ $remise }}">
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" class="form-control-plaintext fw-bold text-dark prix-total-input text-end pe-3" disabled value="{{ number_format($prix_total, 2, '.', '') }}">
                                    </td>
                                    <td class="text-center pe-4">
                                        <button type="button" class="btn btn-outline-danger btn-sm rounded-circle remove-row-btn d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Supprimer" {{ count($oldProduits) <= 1 ? 'disabled' : '' }}>
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light border-top">
                            <tr>
                                <td colspan="4" class="text-end text-primary fw-bold align-middle fs-5">Montant Total Global :</td>
                                <td colspan="2" class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <input type="number" step="0.01" class="form-control-plaintext text-success fw-bold fs-4 p-0 ps-2" id="montant_total" name="montant_total" readonly value="{{ number_format(old('montant_total', $commandeClient->montant_total), 2, '.', '') }}">
                                        <span class="text-success fw-bold fs-5 ms-1">MAD</span>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mb-5">
                    <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm d-inline-flex align-items-center" id="add-row-btn">
                        <i class="bi bi-plus-circle-fill me-2"></i> Ajouter un autre produit
                    </button>
                </div>

                <div class="mb-4">
                    <div class="form-floating">
                        <textarea class="form-control bg-white" id="notes" name="notes" style="height: 100px" placeholder="Notes additionnelles">{{ old('notes', $commandeClient->notes) }}</textarea>
                        <label for="notes">Notes additionnelles</label>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top">
                    <a href="{{ route('commandes.index') }}" class="btn btn-light rounded-pill px-4 shadow-sm border">Annuler</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm fw-bold">
                        <i class="bi bi-check-circle me-2"></i> Mettre à jour la commande
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-floating > .form-control,
    .form-floating > .form-select {
        height: 3.5rem;
        line-height: 1.25;
    }
    .form-floating > label {
        padding: 1rem 0.75rem;
    }
    .form-floating > .form-control:focus,
    .form-floating > .form-control:not(:placeholder-shown),
    .form-floating > .form-select {
        padding-top: 1.625rem;
        padding-bottom: 0.625rem;
    }
    
    .table > :not(caption) > * > * {
        padding: 0.75rem 0.5rem;
    }
    
    .remove-row-btn:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }
    
    .produit-select, .quantite-input, .prix-unitaire-input, .remise-input {
        transition: all 0.2s ease-in-out;
    }
    
    .produit-select:focus, .quantite-input:focus, .prix-unitaire-input:focus, .remise-input:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let rowIdx = document.querySelectorAll('.produit-row').length;
        const tableBody = document.querySelector('#produits-table tbody');
        const montantTotalInput = document.getElementById('montant_total');
        const addRowBtn = document.getElementById('add-row-btn');

        function calculateTotals() {
            let globalTotal = 0;
            document.querySelectorAll('.produit-row').forEach(row => {
                const quantiteInput = row.querySelector('.quantite-input');
                const prixUnitaireInput = row.querySelector('.prix-unitaire-input');
                const remiseInput = row.querySelector('.remise-input');
                const prixTotalInput = row.querySelector('.prix-total-input');

                const quantite = parseFloat(quantiteInput.value) || 0;
                const prixUnitaire = parseFloat(prixUnitaireInput.value) || 0;
                const remise = parseFloat(remiseInput.value) || 0;
                const prixTotal = Math.max(0, (quantite * prixUnitaire) * (1 - remise / 100));
                
                prixTotalInput.value = prixTotal.toFixed(2);
                globalTotal += prixTotal;
            });
            montantTotalInput.value = globalTotal.toFixed(2);
        }

        function updateRowListeners(row) {
            const produitSelect = row.querySelector('.produit-select');
            const quantiteInput = row.querySelector('.quantite-input');
            const prixUnitaireInput = row.querySelector('.prix-unitaire-input');
            const remiseInput = row.querySelector('.remise-input');
            const removeBtn = row.querySelector('.remove-row-btn');

            produitSelect.addEventListener('change', function() {
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
                removeBtn.addEventListener('click', function() {
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

        addRowBtn.addEventListener('click', function() {
            const firstRow = tableBody.querySelector('.produit-row');
            const newRow = firstRow.cloneNode(true);
            
            // Reset inputs
            newRow.querySelectorAll('input').forEach(input => {
                if(input.type !== 'button') {
                    if (input.classList.contains('quantite-input')) {
                        input.value = '1';
                    } else if (input.classList.contains('remise-input')) {
                        input.value = '0';
                    } else {
                        input.value = '';
                    }
                }
            });
            
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
        
        // Initial total calculation in case product prices changed or to just ensure consistency
        calculateTotals();
    });
</script>
@endsection