@extends('_layout')
@section('title', 'Modifier la Commande Fournisseur')
@section('content')

<style>
    .page-header {
        margin-bottom: 1.6rem;
    }
    .page-header h2 {
        font-size: 1.35rem;
        font-weight: 800;
        color: #0f1e4a;
        margin: 0;
        letter-spacing: -0.4px;
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
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        font-size: 0.95rem;
        color: #334155;
        transition: all 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--blue-500);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
        color: white;
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 14px rgba(29,78,216,0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(29,78,216,0.4);
    }
    
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: #f1f5f9;
        color: #475569;
        font-size: 0.95rem;
        font-weight: 700;
        padding: 0.8rem 1.5rem;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1px solid #e2e8f0;
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
    }
</style>

<div class="page-header">
    <h2><i class="bi bi-pencil-square me-2" style="color:var(--blue-500);"></i>Modifier Commande #{{ $commandesFournisseur->id }}</h2>
</div>

<div class="form-card">
    @if($errors->any())
        <div style="background: #fef2f2; color: #b91c1c; padding: 1rem; border-radius: 10px; border: 1px solid #fecaca; margin-bottom: 1.5rem;">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('commandesFournisseurs.update', $commandesFournisseur->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Date de la Commande</label>
                    <input type="date" name="date_commande" class="form-control" value="{{ old('date_commande', \Carbon\Carbon::parse($commandesFournisseur->date_commande)->format('Y-m-d')) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Montant Total (DH)</label>
                    <input type="number" step="0.01" name="montant_total" class="form-control" value="{{ old('montant_total', $commandesFournisseur->montant_total) }}" placeholder="Ex: 1500.00" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Fournisseur</label>
                    <select name="fournisseurs_id" class="form-control" required>
                        <option value="">Sélectionnez un fournisseur</option>
                        @foreach($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}" {{ old('fournisseurs_id', $commandesFournisseur->fournisseurs_id) == $fournisseur->id ? 'selected' : '' }}>
                                {{ $fournisseur->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Employé (Responsable)</label>
                    <select name="employe_id" class="form-control" required>
                        <option value="">Sélectionnez un employé</option>
                        @foreach($employes as $employe)
                            <option value="{{ $employe->id }}" {{ old('employe_id', $commandesFournisseur->employe_id) == $employe->id ? 'selected' : '' }}>
                                {{ $employe->nom_complet }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Statut</label>
            <select name="statut" class="form-control" required>
                <option value="En attente" {{ old('statut', $commandesFournisseur->statut) == 'En attente' ? 'selected' : '' }}>En attente</option>
                <option value="Livrée" {{ old('statut', $commandesFournisseur->statut) == 'Livrée' ? 'selected' : '' }}>Livrée</option>
                <option value="Annulée" {{ old('statut', $commandesFournisseur->statut) == 'Annulée' ? 'selected' : '' }}>Annulée</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Notes / Observations</label>
            <textarea name="notes" class="form-control" rows="4" placeholder="Détails supplémentaires ou remarques...">{{ old('notes', $commandesFournisseur->notes) }}</textarea>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn-submit"><i class="bi bi-save"></i> Mettre à jour</button>
            <a href="{{ route('commandesFournisseurs.index') }}" class="btn-back">Annuler</a>
        </div>
    </form>
</div>

@endsection
