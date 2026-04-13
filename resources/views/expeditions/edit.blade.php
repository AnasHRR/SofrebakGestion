@extends('_layout')

@section('title', 'Modifier l\'Expédition')

@section('content')
<style>
    .page-header {
        margin-bottom: 1.5rem;
    }
    .page-header h2 {
        font-size: 1.35rem;
        font-weight: 800;
        color: #0f1e4a;
        margin: 0;
    }

    .form-card {
        background: #ffffff;
        border: 1px solid #e2eaf8;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(15,42,110,0.06);
        padding: 2rem;
        max-width: 800px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.85rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        width: 100%;
        padding: 0.6rem 0.8rem;
        border: 1.5px solid #e2eaf8;
        border-radius: 9px;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--blue-400);
        box-shadow: 0 0 0 3px rgba(96,165,250,0.15);
        outline: none;
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
        color: #fff;
        padding: 0.6rem 1.5rem;
        border-radius: 9px;
        border: none;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(29,78,216,0.3);
    }
    
    .btn-cancel {
        background: #f1f5f9;
        color: #475569;
        padding: 0.6rem 1.5rem;
        border-radius: 9px;
        border: none;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        margin-right: 0.5rem;
    }
</style>

<div class="page-header">
    <h2>Modifier l'Expédition #{{ $expedition->id }}</h2>
</div>

<div class="form-card">
    @if ($errors->any())
        <div class="alert alert-danger" style="background:#fef2f2; color:#ef4444; border:1px solid #fecaca; padding:1rem; border-radius:9px; margin-bottom:1.5rem;">
            <ul style="margin:0; padding-left:1.2rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('expeditions.update', $expedition->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6 form-group">
                <label class="form-label">Commande Client</label>
                <select name="commande_client_id" class="form-select" required>
                    <option value="">Sélectionner une commande</option>
                    @foreach($commandesClients as $commande)
                        <option value="{{ $commande->id }}" {{ old('commande_client_id', $expedition->commande_client_id) == $commande->id ? 'selected' : '' }}>
                            {{ $commande->numero_commande ?? '#'.$commande->id }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-6 form-group">
                <label class="form-label">Chauffeur</label>
                <select name="chauffeur_id" class="form-select" required>
                    <option value="">Sélectionner un chauffeur</option>
                    @foreach($chauffeurs as $chauffeur)
                        <option value="{{ $chauffeur->id }}" {{ old('chauffeur_id', $expedition->chauffeur_id) == $chauffeur->id ? 'selected' : '' }}>
                            {{ $chauffeur->nom_complet }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="form-label">Date d'Expédition</label>
                <input type="date" name="date_expedition" class="form-control" value="{{ old('date_expedition', $expedition->date_expedition ? \Carbon\Carbon::parse($expedition->date_expedition)->format('Y-m-d') : '') }}" required>
            </div>
            
            <div class="col-md-6 form-group">
                <label class="form-label">Numéro du Camion</label>
                <input type="text" name="numero_camion" class="form-control" value="{{ old('numero_camion', $expedition->numero_camion) }}" placeholder="Ex: 12345|A|1" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="form-label">Statut de Livraison</label>
                <select name="statut_livraison" class="form-select" required>
                    <option value="En cours" {{ old('statut_livraison', $expedition->statut_livraison) == 'En cours' ? 'selected' : '' }}>En cours</option>
                    <option value="Livré" {{ old('statut_livraison', $expedition->statut_livraison) == 'Livré' ? 'selected' : '' }}>Livré</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">Notes de Livraison</label>
            <textarea name="notes_livraison" class="form-control" rows="3" placeholder="Informations complémentaires...">{{ old('notes_livraison', $expedition->notes_livraison) }}</textarea>
        </div>

        <div class="mt-4">
            <a href="{{ route('expeditions.index') }}" class="btn-cancel">Annuler</a>
            <button type="submit" class="btn-submit">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
