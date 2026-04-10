@extends('_layout')

@section('title', 'Stock')

@section('content')
    <h1>Stock</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produit ID</th>
                <th>Type Mouvement</th>
                <th>Quantite</th>
                <th>Date Mouvement</th>
                <th>Reference ID</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
                <tr>
                    <td>{{ $stock->id }}</td>
                    <td>{{ $stock->produit_id }}</td>
                    <td>{{ $stock->type_mouvement }}</td>
                    <td>{{ $stock->quantite }}</td>
                    <td>{{ $stock->date_mouvement }}</td>
                    <td>{{ $stock->reference_id }}</td>
                    <td>{{ $stock->notes }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
