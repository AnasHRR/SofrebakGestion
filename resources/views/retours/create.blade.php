@extends('_layout')
@section('title', 'Retours')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ajouter un retour</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('retours.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="commande_client_id">Commande Client</label>
                                <select name="commande_client_id" id="commande_client_id" class="form-control">
                                    <option value="">Sélectionner une commande</option>
                                    @foreach ($commandes as $commande)
                                        <option value="{{ $commande->id }}">{{ $commande->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="produit_id">Produit</label>
                                <select name="produit_id" id="produit_id" class="form-control">
                                    <option value="">Sélectionner un produit</option>
                                    @foreach ($produits as $produit)
                                        <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantite">Quantité</label>
                                <input type="number" name="quantite" id="quantite" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="date_retour">Date Retour</label>
                                <input type="date" name="date_retour" id="date_retour" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="motif">Motif</label>
                                <textarea name="motif" id="motif" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="comptable_id">Comptable</label>
                                <select name="comptable_id" id="comptable_id" class="form-control">
                                    <option value="">Sélectionner un comptable</option>
                                    @foreach ($comptables as $comptable)
                                        <option value="{{ $comptable->id }}">{{ $comptable->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="region_id">Région</label>
                                <select name="region_id" id="region_id" class="form-control">
                                    <option value="">Sélectionner une région</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea name="notes" id="notes" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection