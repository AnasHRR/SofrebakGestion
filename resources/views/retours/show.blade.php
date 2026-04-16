@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Détails du retour</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>ID:</strong> {{ $retours->id }}</p>
                        <p><strong>Commande Client:</strong> {{ $retours->commande_client_id }}</p>
                        <p><strong>Produit:</strong> {{ $retours->produit_id }}</p>
                        <p><strong>Quantité:</strong> {{ $retours->quantite }}</p>
                        <p><strong>Date Retour:</strong> {{ $retours->date_retour }}</p>
                        <p><strong>Motif:</strong> {{ $retours->motif }}</p>
                        <p><strong>Comptable:</strong> {{ $retours->comptable_id }}</p>
                        <p><strong>Région:</strong> {{ $retours->region_id }}</p>
                        <p><strong>Notes:</strong> {{ $retours->notes }}</p>
                        <a href="{{ route('retours.index') }}" class="btn btn-primary">Retour</a>
                        <a href="{{ route('retours.edit', $retours->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('retours.destroy', $retours->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection