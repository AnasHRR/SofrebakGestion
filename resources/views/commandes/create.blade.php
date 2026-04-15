@extends('_layout')

@section('title', 'Créer une Commande')

@section('content')
<style>
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
        background: #f1f5f9;
        color: #475569;
        padding: 0.55rem 1.1rem;
        border-radius: 10px;
        font-size: 0.84rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    .form-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1rem;
        font-weight: 800;
        color: var(--blue-600);
        margin-bottom: 1.2rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f1f5fb;
    }

    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-label {
        display: block;
        font-size: 0.82rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.4rem;
    }

    .form-control, .form-select {
        width: 100%;
        padding: 0.6rem 0.8rem;
        border: 1.5px solid #e2eaf8;
        border-radius: 9px;
        font-size: 0.88rem;
        color: #334155;
        transition: all 0.2s;
        background-color: #fafbff;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--blue-400);
        box-shadow: 0 0 0 3px rgba(96,165,250,0.15);
        outline: none;
        background-color: #ffffff;
    }

    /* Table styles for products */
    .products-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 0.5rem;
    }
    .products-table th {
        color: #64748b;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0 1rem 0.5rem;
        border-bottom: 1.5px solid #e2eaf8;
    }
    .produit-row td {
        padding: 0.5rem;
        background: #f8fafc;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
    }
    .produit-row td:first-child {
        border-left: 1px solid #f1f5f9;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }
    .produit-row td:last-child {
        border-right: 1px solid #f1f5f9;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .input-table {
        border: 1.5px solid #e2eaf8;
        border-radius: 7px;
        padding: 0.5rem 0.6rem;
        font-size: 0.85rem;
        width: 100%;
        background: #fff;
    }
    .input-table:focus {
        border-color: var(--blue-400);
        outline: none;
    }
    
    .input-disabled-look {
        background: transparent;
        border: none;
        font-weight: 700;
        color: #0f1e4a;
        width: 100%;
        outline: none;
    }

    .btn-action-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-remove {
        background: #fff5f5;
        color: #ef4444;
        border: 1.5px solid #fecaca;
    }
    .btn-remove:hover:not(:disabled) {
        background: #fee2e2;
    }
    .btn-remove:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn-add-row {
        background: #eff6ff;
        color: var(--blue-600);
        border: 1.5px dashed var(--blue-300);
        padding: 0.6rem 1rem;
        border-radius: 9px;
        font-size: 0.85rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        width: 100%;
        justify-content: center;
        margin-top: 0.5rem;
    }
    .btn-add-row:hover {
        background: #e0f2fe;
        border-color: var(--blue-400);
    }

    .total-box {
        background: #f0fdf4;
        border: 1.5px solid #bbf7d0;
        border-radius: 12px;
        padding: 1.2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1.5rem;
    }
    .total-label {
        font-size: 1rem;
        font-weight: 700;
        color: #166534;
    }
    .total-amount {
        font-size: 1.8rem;
        font-weight: 800;
        color: #15803d;
        letter-spacing: -0.5px;
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
        color: #fff;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        border: none;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 14px rgba(29,78,216,0.3);
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(29,78,216,0.4);
    }

    .alert-danger {
        background:#fef2f2; 
        color:#ef4444; 
        border:1px solid #fecaca; 
        padding:1rem; 
        border-radius:12px; 
        margin-bottom:1.5rem;
    }
</style>

<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-cart-plus me-2" style="color:var(--blue-500);"></i>Nouvelle Commande</h2>
        <p>Saisissez les informations de la commande et ajoutez des produits</p>
    </div>
    <a href="{{ route('commandes.index') }}" class="btn-back">
        <i class="bi bi-arrow-left me-1"></i> Retour
    </a>
</div>

@if ($errors->any())
    <div class="alert-danger">
        <div style="font-weight: 700; margin-bottom: 0.5rem;"><i class="bi bi-exclamation-triangle-fill me-2"></i>Erreur(s) :</div>
        <ul style="margin:0; padding-left:1.5rem; font-size: 0.85rem;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('commandes.store') }}" method="POST">
    @csrf
    <div class="form-card">
        <div class="section-title"><i class="bi bi-info-circle me-2"></i>Informations Générales</div>
        <div class="row">
            <div class="col-md-3 form-group">
                <label class="form-label" for="numero_commande">N° Commande</label>
                <input type="text" class="form-control" id="numero_commande" name="numero_commande" required>
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label" for="date_commande">Date Commande</label>
                <input type="date" class="form-control" id="date_commande" name="date_commande" value="{{ old('date_commande') ?? date('Y-m-d') }}" required>
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label" for="client_id">Client</label>
                <select class="form-select" id="client_id" name="client_id" required>
                    <option value="">Sélectionnez un client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->nom_entreprise }} ({{ $client->personne_contact }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label" for="expedition_id">Expédition</label>
                <select class="form-select" id="expedition_id" name="expedition_id">
                    <option value="">Non assignée</option>
                    @foreach ($expeditions as $exped)
                        <option value="{{ $exped->id }}" {{ old('expedition_id') == $exped->id ? 'selected' : '' }}>
                            {{ $exped->employes->nom_complet ?? 'N/A' }} - {{ \Carbon\Carbon::parse($exped->date_expedition)->format('d/m/Y') }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                <label class="form-label" for="date_livraison">Date Livraison Prévue</label>
                <input type="date" class="form-control" id="date_livraison" name="date_livraison" value="{{ old('date_livraison') }}">
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label" for="statut">Statut d'Avancement</label>
                <select class="form-select" id="statut" name="statut">
                    <option value="Nouvelle" {{ old('statut') == 'Nouvelle' ? 'selected' : '' }}>Nouvelle</option>
                    <option value="En préparation" {{ old('statut') == 'En préparation' ? 'selected' : '' }}>En préparation</option>
                    <option value="Expédiée" {{ old('statut') == 'Expédiée' ? 'selected' : '' }}>Expédiée</option>
                    <option value="Livrée" {{ old('statut') == 'Livrée' ? 'selected' : '' }}>Livrée</option>
                </select>   
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label" for="statut_paiement">Statut Paiement</label>
                <select class="form-select" id="statut_paiement" name="statut_paiement">
                    <option value="Non payé" {{ old('statut_paiement') == 'Non payé' ? 'selected' : '' }}>Non payé</option>
                    <option value="Partiellement payé" {{ old('statut_paiement') == 'Partiellement payé' ? 'selected' : '' }}>Partiellement payé</option>
                    <option value="Payé" {{ old('statut_paiement') == 'Payé' ? 'selected' : '' }}>Payé</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label" for="comptable_id">Comptable Associé</label>
                <select class="form-select" id="comptable_id" name="comptable_id">
                    <option value="">Sélectionnez</option>
                    @foreach ($employes as $emp)
                        <option value="{{ $emp->id }}" {{ old('comptable_id') == $emp->id ? 'selected' : '' }}>
                            {{ $emp->nom_complet }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="section-title"><i class="bi bi-box-seam me-2"></i>Produits de la commande</div>
        
        <table class="products-table" id="produits-table">
            <thead>
                <tr>
                    <th style="width:35%;">Produit</th>
                    <th style="width:12%;">Quantité</th>
                    <th style="width:15%;">Prix U. (DH)</th>
                    <th style="width:12%;">Remise (%)</th>
                    <th style="width:18%;">Total Ligne (DH)</th>
                    <th style="width:8%; text-align:center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="produit-row">
                    <td>
                        <select class="input-table produit-select" name="produits[0][produit_id]" required>
                            <option value="" data-prix="0">Sélectionner...</option>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}" data-prix="{{ $produit->prix_vente }}">
                                    {{ $produit->nom_produit }} (Dispo: {{ $produit->stock_actuel }})
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" class="input-table quantite-input" name="produits[0][quantite]" min="1" value="1" required>
                    </td>
                    <td>
                        <input type="number" step="0.01" class="input-table prix-unitaire-input" name="produits[0][prix_unitaire]" required readonly>
                    </td>
                    <td>
                        <input type="number" step="0.01" class="input-table remise-input" name="produits[0][remise]" min="0" max="100" value="0">
                    </td>
                    <td>
                        <input type="text" class="input-disabled-look prix-total-input" disabled value="0.00">
                    </td>
                    <td style="text-align:center;">
                        <button type="button" class="btn-action-icon btn-remove remove-row-btn" disabled title="Supprimer">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn-add-row" id="add-row-btn">
            <i class="bi bi-plus-circle-fill"></i> Ajouter une ligne de produit
        </button>

        <div class="total-box">
            <div class="total-label">Montant Total de la Commande</div>
            <div class="d-flex align-items-baseline gap-1">
                <span style="font-weight: 700; color:#16a34a; font-size:1.2rem;">MAD</span>
                <input type="text" style="background:transparent; border:none; width:150px; text-align:right;" class="total-amount p-0 text-success" id="montant_total" name="montant_total" readonly value="0.00">
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="section-title"><i class="bi bi-journal-text me-2"></i>Informations Spéciales</div>
        <div class="form-group mb-0">
            <label for="notes" class="form-label">Notes de livraison ou remarques pour l'équipe</label>
            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Tapez vos instructions libres ici...">{{ old('notes') }}</textarea>
        </div>
    </div>

    <div style="text-align: right; margin-bottom: 3rem;">
        <button type="submit" class="btn-submit">
            <i class="bi bi-check2-circle me-1"></i> Créer la Commande
        </button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let rowIdx = 1;
        const tableBody = document.querySelector('#produits-table tbody');
        const montantTotalInput = document.getElementById('montant_total');
        const addRowBtn = document.getElementById('add-row-btn');

        function formatCurrency(value) {
            return parseFloat(value).toFixed(2);
        }

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
                
                const unitAfterDiscount = prixUnitaire * (1 - (remise / 100));
                const prixTotal = Math.max(0, quantite * unitAfterDiscount);
                
                prixTotalInput.value = formatCurrency(prixTotal);
                globalTotal += prixTotal;
            });
            
            // Allow input box to scale visually
            montantTotalInput.value = formatCurrency(globalTotal);
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
                if (prix !== null && prix !== "") {
                    prixUnitaireInput.value = formatCurrency(prix);
                } else {
                    prixUnitaireInput.value = '';
                }
                calculateTotals();
            });

            [quantiteInput, prixUnitaireInput, remiseInput].forEach(inp => {
                inp.addEventListener('input', calculateTotals);
            });

            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    const rows = document.querySelectorAll('.produit-row');
                    if (rows.length > 1) {
                        row.style.opacity = '0';
                        row.style.transform = 'translateY(10px)';
                        row.style.transition = 'all 0.2s';
                        setTimeout(() => {
                            row.remove();
                            calculateTotals();
                            updateRemoveButtons();
                        }, 200);
                    }
                });
            }
        }

        function updateRemoveButtons() {
            const rows = document.querySelectorAll('.produit-row');
            const removeBtns = document.querySelectorAll('.remove-row-btn');
            removeBtns.forEach(btn => {
                btn.disabled = rows.length <= 1;
            });
        }

        // Initialize first row
        updateRowListeners(tableBody.querySelector('.produit-row'));

        addRowBtn.addEventListener('click', function() {
            const firstRow = tableBody.querySelector('.produit-row');
            const newRow = firstRow.cloneNode(true);
            
            // Clean up animation artifacts if cloned
            newRow.style.opacity = '1';
            newRow.style.transform = 'none';

            // Reset simple inputs
            newRow.querySelectorAll('input').forEach(input => {
                if (input.classList.contains('quantite-input')) {
                    input.value = '1';
                } else if (input.classList.contains('remise-input')) {
                    input.value = '0';
                } else if (input.classList.contains('prix-total-input')) {
                    input.value = '0.00';
                } else {
                    input.value = '';
                }
            });
            
            // Reset Select
            const select = newRow.querySelector('.produit-select');
            select.selectedIndex = 0;
            
            // Enforce array index naming for laravel request payload
            select.name = `produits[${rowIdx}][produit_id]`;
            newRow.querySelector('.quantite-input').name = `produits[${rowIdx}][quantite]`;
            newRow.querySelector('.prix-unitaire-input').name = `produits[${rowIdx}][prix_unitaire]`;
            newRow.querySelector('.remise-input').name = `produits[${rowIdx}][remise]`;
            
            tableBody.appendChild(newRow);
            
            // Enhance entrance animation
            newRow.style.opacity = '0';
            newRow.style.transform = 'translateY(-10px)';
            newRow.style.transition = 'all 0.3s ease-out';
            setTimeout(() => {
                newRow.style.opacity = '1';
                newRow.style.transform = 'none';
            }, 10);
            
            updateRowListeners(newRow);
            updateRemoveButtons();
            rowIdx++;
        });
    });
</script>
@endsection
