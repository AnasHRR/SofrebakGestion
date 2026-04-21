@extends('_layout')

@section('title', 'Nouveau Retour - Sofrebak')

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

    /* ── Products Table ── */
    .products-table-container {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid #e2eaf8;
    }

    .table-products {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 0.75rem;
    }

    .table-products th {
        font-size: 0.75rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        padding: 0 1rem;
        border: none;
    }

    .btn-add-row {
        background: #f1f5f9;
        color: #475569;
        border: 1.5px dashed #cbd5e1;
        border-radius: 10px;
        padding: 0.6rem;
        font-weight: 700;
        font-size: 0.84rem;
        width: 100%;
        transition: all 0.2s;
    }

    .btn-add-row:hover {
        background: #e2eaf8;
        border-color: var(--blue-300);
        color: var(--blue-600);
    }

    .btn-remove-row {
        background: #fff1f2;
        color: #e11d48;
        border: 1px solid #fecdd3;
        width: 38px;
        height: 38px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .btn-remove-row:hover {
        background: #e11d48;
        color: #fff;
    }
</style>

<div class="page-header">
    <div class="page-header-left">
        <h2><i class="bi bi-plus-circle-fill me-2" style="color:var(--blue-500);"></i>Nouveau Retour</h2>
        <p>Enregistrez un ou plusieurs produits en retour</p>
    </div>
    <a href="{{ route('retours.index') }}" class="btn-back">
        <i class="bi bi-arrow-left me-1"></i> Retour à la liste
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-12">
        @if ($errors->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px; font-weight: 600;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ $errors->first('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="form-card">
            <form action="{{ route('retours.store') }}" method="POST" id="retourForm">
                @csrf
                
                <div class="row g-4">
                    <!-- Informations Générales -->
                    <div class="col-12">
                        <div class="section-title">
                            <i class="bi bi-receipt"></i> Informations Générales
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Commande Client</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-hash"></i></span>
                            <select name="commande_client_id" id="commande_client_id" class="form-select @error('commande_client_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Sélectionner une commande</option>
                                @foreach($commandes as $cmd)
                                    <option value="{{ $cmd->id }}" {{ old('commande_client_id') == $cmd->id ? 'selected' : '' }}>
                                        Commande {{ $cmd->numero_commande ?? '#'.$cmd->id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('commande_client_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Date de Retour</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                            <input type="date" name="date_retour" class="form-control @error('date_retour') is-invalid @enderror" value="{{ old('date_retour', date('Y-m-d')) }}" required>
                        </div>
                        @error('date_retour') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Région</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <select name="region_id" class="form-select @error('region_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Choisir une région</option>
                                @foreach($regions as $reg)
                                    <option value="{{ $reg->id }}" {{ old('region_id') == $reg->id ? 'selected' : '' }}>{{ $reg->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('region_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Responsable (Comptable)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <select name="comptable_id" class="form-select @error('comptable_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Choisir un responsable</option>
                                @foreach($employes as $emp)
                                    <option value="{{ $emp->id }}" {{ old('comptable_id') == $emp->id ? 'selected' : '' }}>{{ $emp->nom_complet }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('comptable_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <!-- Liste des Produits -->
                    <div class="col-12 mt-5">
                        <div class="section-title">
                            <i class="bi bi-box-seam"></i> Produits à retourner
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="products-table-container">
                            <table class="table-products" id="productsTable">
                                <thead>
                                    <tr>
                                        <th style="width: 40%;">Produit</th>
                                        <th style="width: 15%;">Quantité</th>
                                        <th style="width: 25%;">Motif</th>
                                        <th style="width: 15%;">Notes</th>
                                        <th style="width: 50px;"></th>
                                    </tr>
                                </thead>
                                <tbody id="productsBody">
                                    @php
                                        $oldProduits = old('produits', [[]]);
                                    @endphp
                                    @foreach($oldProduits as $index => $oldProd)
                                        <tr class="product-row">
                                            <td>
                                                <select name="produits[{{ $index }}][produit_id]" class="form-select produit-select @error('produits.'.$index.'.produit_id') is-invalid @enderror" required disabled>
                                                    <option value="" selected disabled>Sélectionner un produit</option>
                                                    @if(isset($oldProd['produit_id']))
                                                        <option value="{{ $oldProd['produit_id'] }}" selected>Chargement...</option>
                                                    @endif
                                                </select>
                                                @error('produits.'.$index.'.produit_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </td>
                                            <td>
                                                <input type="number" name="produits[{{ $index }}][quantite]" class="form-control @error('produits.'.$index.'.quantite') is-invalid @enderror" placeholder="0" min="1" value="{{ $oldProd['quantite'] ?? '' }}" required>
                                                @error('produits.'.$index.'.quantite') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </td>
                                            <td>
                                                <select name="produits[{{ $index }}][motif]" class="form-select @error('produits.'.$index.'.motif') is-invalid @enderror" required>
                                                    <option value="" selected disabled>Motif</option>
                                                    <option value="Endommagé" {{ (isset($oldProd['motif']) && $oldProd['motif'] == 'Endommagé') ? 'selected' : '' }}>Endommagé</option>
                                                    <option value="Périmé" {{ (isset($oldProd['motif']) && $oldProd['motif'] == 'Périmé') ? 'selected' : '' }}>Périmé</option>
                                                    <option value="Non conforme" {{ (isset($oldProd['motif']) && $oldProd['motif'] == 'Non conforme') ? 'selected' : '' }}>Non conforme</option>
                                                    <option value="Autre" {{ (isset($oldProd['motif']) && $oldProd['motif'] == 'Autre') ? 'selected' : '' }}>Autre</option>
                                                </select>
                                                @error('produits.'.$index.'.motif') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="produits[{{ $index }}][notes]" class="form-control" placeholder="Notes (opt.)" value="{{ $oldProd['notes'] ?? '' }}">
                                            </td>
                                            <td>
                                                <button type="button" class="btn-remove-row" style="{{ count($oldProduits) <= 1 ? 'display: none;' : 'display: flex;' }}"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="button" id="addRow" class="btn-add-row mt-3">
                                <i class="bi bi-plus-lg me-1"></i> Ajouter un autre produit
                            </button>
                        </div>
                        @error('produits') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 mt-4 text-end">
                        <button type="reset" class="btn btn-light me-2 fw-bold px-4 border">Réinitialiser</button>
                        <button type="submit" class="btn btn-submit">
                            <i class="bi bi-check-lg me-1"></i> Enregistrer le Retour
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const commandeSelect = document.getElementById('commande_client_id');
    const productsBody = document.getElementById('productsBody');
    const addRowBtn = document.getElementById('addRow');
    let productsList = [];
    let rowCount = {{ count($oldProduits) }};

    // Load products when command changes
    commandeSelect.addEventListener('change', function() {
        const commandeId = this.value;
        if (!commandeId) return;

        // Fetch products for the selected command
        fetch(`/commandes/${commandeId}/produits`)
            .then(response => response.json())
            .then(data => {
                productsList = data;
                updateAllProductSelects();
            })
            .catch(error => {
                console.error('Error fetching products:', error);
            });
    });

    function updateAllProductSelects() {
        const selects = document.querySelectorAll('.produit-select');
        selects.forEach(select => {
            const currentValue = select.getAttribute('data-value') || select.value;
            select.innerHTML = '<option value="" selected disabled>Sélectionner un produit</option>';
            
            if (productsList.length === 0) {
                select.innerHTML = '<option value="" selected disabled>Aucun produit trouvé</option>';
                select.disabled = true;
            } else {
                productsList.forEach(produit => {
                    const option = document.createElement('option');
                    option.value = produit.id;
                    option.textContent = produit.nom_produit;
                    if (produit.id == currentValue) option.selected = true;
                    select.appendChild(option);
                });
                select.disabled = false;
            }
        });
    }

    // Add row
    addRowBtn.addEventListener('click', function() {
        const newRow = document.createElement('tr');
        newRow.className = 'product-row';
        newRow.innerHTML = `
            <td>
                <select name="produits[${rowCount}][produit_id]" class="form-select produit-select" required>
                    <option value="" selected disabled>Sélectionner un produit</option>
                </select>
            </td>
            <td>
                <input type="number" name="produits[${rowCount}][quantite]" class="form-control" placeholder="0" min="1" required>
            </td>
            <td>
                <select name="produits[${rowCount}][motif]" class="form-select" required>
                    <option value="" selected disabled>Motif</option>
                    <option value="Endommagé">Endommagé</option>
                    <option value="Périmé">Périmé</option>
                    <option value="Non conforme">Non conforme</option>
                    <option value="Autre">Autre</option>
                </select>
            </td>
            <td>
                <input type="text" name="produits[${rowCount}][notes]" class="form-control" placeholder="Notes (opt.)">
            </td>
            <td>
                <button type="button" class="btn-remove-row"><i class="bi bi-trash"></i></button>
            </td>
        `;
        productsBody.appendChild(newRow);
        
        // Populate the new select
        const newSelect = newRow.querySelector('.produit-select');
        productsList.forEach(produit => {
            const option = document.createElement('option');
            option.value = produit.id;
            option.textContent = produit.nom_produit;
            newSelect.appendChild(option);
        });
        if (productsList.length === 0) newSelect.disabled = true;

        rowCount++;
        updateRemoveButtons();
    });

    // Remove row
    productsBody.addEventListener('click', function(e) {
        if (e.target.closest('.btn-remove-row')) {
            e.target.closest('tr').remove();
            updateRemoveButtons();
        }
    });

    function updateRemoveButtons() {
        const rows = productsBody.querySelectorAll('tr');
        const removeBtns = productsBody.querySelectorAll('.btn-remove-row');
        if (rows.length <= 1) {
            removeBtns[0].style.display = 'none';
        } else {
            removeBtns.forEach(btn => btn.style.display = 'flex');
        }
    }

    // Handle initial state if validation failed (old input)
    if (commandeSelect.value) {
        // Store current values as data attributes for updateAllProductSelects
        document.querySelectorAll('.produit-select').forEach(select => {
            if (select.value) select.setAttribute('data-value', select.value);
        });
        commandeSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection
