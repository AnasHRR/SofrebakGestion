@extends('_layout')
@section('title' , 'les Expeditions')
@section('content')
    <div class="container">
        @foreach ($expeditions as $exp)
            <p>{{ $exp->commandesClient->numero_commande }}</p>
        @endforeach
    </div>
@endsection