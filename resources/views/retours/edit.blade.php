@extends('_layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Modifier le retour</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('retours.update', $retours->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="commande_client_id">Commande Client</label>
                                <input type="text" name="commande_client_id" id="commande_client_id" class="form-control" value="{{ $retours->commande_client_id }}">
                            </div>
                            <div class="form-group">
                                <label for="produit_id">Produit</label>
                                <input type="text" name="produit_id" id="produit_id" class="form-control" value="{{ $retours->produit_id }}">
                            </div>
                            <div class="form-group">
                                <label for="quantite">Quantité</label>
                                <input type="text" name="quantite" id="quantite" class="form-control" value="{{ $retours->quantite }}">
                            </div>
                            <div class="form-group">
                                <label for="date_retour">Date Retour</label>
                                <input type="text" name="date_retour" id="date_retour" class="form-control" value="{{ $retours->date_retour }}">
                            </div>
                            <div class="form-group">
                                <label for="motif">Motif</label>
                                <input type="text" name="motif" id="motif" class="form-control" value="{{ $retours->motif }}">
                            </div>
                            <div class="form-group">
                                <label for="comptable_id">Comptable</label>
                                <input type="text" name="comptable_id" id="comptable_id" class="form-control" value="{{ $retours->comptable_id }}">
                            </div>
                            <div class="form-group">
                                <label for="region_id">Région</label>
                                <input type="text" name="region_id" id="region_id" class="form-control" value="{{ $retours->region_id }}">
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <input type="text" name="notes" id="notes" class="form-control" value="{{ $retours->notes }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection