@extends('_layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Retours</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Commande Client</th>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Date Retour</th>
                                    <th>Motif</th>
                                    <th>Comptable</th>
                                    <th>Région</th>
                                    <th>Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($retours as $retour)
                                    <tr>
                                        <td>{{ $retour->id }}</td>
                                        <td>{{ $retour->commande_client_id }}</td>
                                        <td>{{ $retour->produit_id }}</td>
                                        <td>{{ $retour->quantite }}</td>
                                        <td>{{ $retour->date_retour }}</td>
                                        <td>{{ $retour->motif }}</td>
                                        <td>{{ $retour->comptable_id }}</td>
                                        <td>{{ $retour->region_id }}</td>
                                        <td>{{ $retour->notes }}</td>
                                        <td>
                                            <a href="{{ route('retours.show', $retour->id) }}" class="btn btn-primary">Voir</a>
                                            <a href="{{ route('retours.edit', $retour->id) }}" class="btn btn-warning">Modifier</a>
                                            <form action="{{ route('retours.destroy', $retour->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection