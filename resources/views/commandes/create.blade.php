@extends('_layout')

@section('title', 'Créer une Commande')

@section('content')
<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0 fw-bold text-dark" style="letter-spacing: -0.5px;">Nouvelle Commande</h2>
            <p class="text-muted mb-0">Créez et configurez une nouvelle commande client</p>
        </div>
        <a href="{{ route('commandes.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm fw-medium">
            &larr; Retour à la liste
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm border-0 rounded-4 mb-4">
            <div class="d-flex align-items-center mb-2">
                <strong class="fs-5">Il y a eu des erreurs avec votre soumission</strong>
            </div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 px-md-5">
            <h5 class="text-primary fw-bold mb-0">Informations Générales</h5>
        </div>
        <div class="card-body p-4 p-md-5 pt-md-4">
            <form action="{{ route('commandes.store') }}" method="POST">
                @csrf

                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <label for="numero_commande" class="form-label fw-semibold text-secondary">Numéro Commande</label>
                        <input type="text" class="form-control form-control-lg bg-light border-0 shadow-none" id="numero_commande" name="numero_commande" value="{{ old('numero_commande') }}" required placeholder="Ex: CMD-2023-001">
                    </div>

                    <div class="col-md-6">
                        <label for="date_commande" class="form-label fw-semibold text-secondary">Date Commande</label>
                        <input type="date" class="form-control form-control-lg bg-light border-0 shadow-none" id="date_commande" name="date_commande" value="{{ old('date_commande') ?? date('Y-m-d') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="client_id" class="form-label fw-semibold text-secondary">Client</label>
                        <select class="form-select form-select-lg bg-light border-0 shadow-none" id="client_id" name="client_id" required>
                            <option value="">Sélectionnez un client</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->nom_entreprise }} ({{ $client->personne_contact }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="comptable_id" class="form-label fw-semibold text-secondary">Comptable</label>
                        <select class="form-select form-select-lg bg-light border-0 shadow-none" id="comptable_id" name="comptable_id">
                            <option value="">Sélectionnez un comptable</option>
                            @foreach ($employes as $emp)
                                <option value="{{ $emp->id }}" {{ old('comptable_id') == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->nom_complet }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="date_livraison" class="form-label fw-semibold text-secondary">Date Livraison</label>
                        <input type="date" class="form-control form-control-lg bg-light border-0 shadow-none" id="date_livraison" name="date_livraison" value="{{ old('date_livraison') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="statut" class="form-label fw-semibold text-secondary">Statut</label>
                        <select class="form-select form-select-lg bg-light border-0 shadow-none" id="statut" name="statut">
                            <option value="Nouvelle" {{ old('statut') == 'Nouvelle' ? 'selected' : '' }}>Nouvelle</option>
                            <option value="En préparation" {{ old('statut') == 'En préparation' ? 'selected' : '' }}>En préparation</option>
                            <option value="Expédiée" {{ old('statut') == 'Expédiée' ? 'selected' : '' }}>Expédiée</option>
                            <option value="Livrée" {{ old('statut') == 'Livrée' ? 'selected' : '' }}>Livrée</option>
                            <option value="Annulée" {{ old('statut') == 'Annulée' ? 'selected' : '' }}>Annulée</option>
                        </select>   
                    </div>

                    <div class="col-md-6">
                        <label for="statut_paiement" class="form-label fw-semibold text-secondary">Statut Paiement</label>
                        <select class="form-select form-select-lg bg-light border-0 shadow-none" id="statut_paiement" name="statut_paiement">
                            <option value="Non payé" {{ old('statut_paiement') == 'Non payé' ? 'selected' : '' }}>Non payé</option>
                            <option value="Partiellement payé" {{ old('statut_paiement') == 'Partiellement payé' ? 'selected' : '' }}>Partiellement payé</option>
                            <option value="Payé" {{ old('statut_paiement') == 'Payé' ? 'selected' : '' }}>Payé</option>
                        </select>
                    </div>
                </div>

                <hr class="my-5 border-secondary border-opacity-25">

                <h5 class="text-primary fw-bold mb-4">Produits de la commande</h5>
                <div class="table-responsive rounded-3 shadow-sm border mb-4">
                    <table class="table table-hover align-middle mb-0" id="produits-table">
                        <thead class="table-light">
                            <tr>
                                <th class="text-secondary fw-semibold border-0 py-3">Produit</th>
                                <th class="text-secondary fw-semibold border-0 py-3" style="width: 140px;">Quantité</th>
                                <th class="text-secondary fw-semibold border-0 py-3" style="width: 160px;">Prix Unitaire</th>
                                <th class="text-secondary fw-semibold border-0 py-3" style="width: 120px;">Remise (%)</th>
                                <th class="text-secondary fw-semibold border-0 py-3" style="width: 160px;">Prix Total</th>
                                <th class="text-secondary fw-semibold border-0 py-3 text-center" style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            <tr class="produit-row">
                                <td class="border-light">
                                    <select class="form-select bg-light border-0 produit-select" name="produits[0][produit_id]" required>
                                        <option value="" data-prix="0">Sélectionnez un produit</option>
                                        @foreach ($produits as $produit)
                                            <option value="{{ $produit->id }}" data-prix="{{ $produit->prix_vente }}">{{ $produit->nom_produit }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="border-light">
                                    <input type="number" class="form-control bg-light border-0 quantite-input" name="produits[0][quantite]" min="1" value="1" required>
                                </td>
                                <td class="border-light">
                                    <input type="number" step="0.01" class="form-control bg-light border-0 prix-unitaire-input" name="produits[0][prix_unitaire]" required readonly>
                                </td>
                                <td class="border-light">
                                    <input type="number" step="0.01" class="form-control bg-light border-0 remise-input" name="produits[0][remise]" min="0" value="0">
                                </td>
                                <td class="border-light">
                                    <input type="number" step="0.01" class="form-control-plaintext fw-bold px-3 text-dark prix-total-input" disabled value="0.00">
                                </td>
                                <td class="border-light text-center">
                                    <button type="button" class="btn btn-danger btn-sm remove-row-btn fw-bold" disabled>supprimer</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="table-light border-top">
                            <tr>
                                <td colspan="4" class="text-end text-secondary fw-semibold align-middle pe-4">Montant Total :</td>
                                <td colspan="2">
                                    <input type="number" step="0.01" class="form-control-plaintext text-success fs-4 fw-bold p-0 ps-3" id="montant_total" name="montant_total" readonly value="0.00">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mb-5">
                    <button type="button" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm" id="add-row-btn">
                        + Ajouter un produit
                    </button>
                </div>

                <div class="mb-5">
                    <label for="notes" class="form-label fw-semibold text-secondary">Notes additionnelles</label>
                    <textarea class="form-control bg-light border-0 shadow-none" id="notes" name="notes" rows="4" placeholder="Ajoutez des détails concernant cette commande...">{{ old('notes') }}</textarea>
                </div>

                <div class="d-flex justify-content-end mt-5 pt-4 border-top">
                    <button type="submit" class="btn btn-success btn-lg rounded-pill px-5 shadow-sm fw-bold">
                        Enregistrer la commande
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let rowIdx = 1;
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

            // Initialize first row listeners
            updateRowListeners(tableBody.querySelector('.produit-row'));

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
        });
    </script>
@endsection
