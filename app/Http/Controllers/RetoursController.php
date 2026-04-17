<?php

namespace App\Http\Controllers;

use App\Models\Retours;
use App\Models\CommandeClient;
use App\Models\Produits;
use App\Models\regions;
use App\Models\employes;
use Illuminate\Http\Request;

class RetoursController extends Controller
{
    
    public function index()
    {
        $retours = Retours::with(['commande_client', 'produit', 'comptable', 'region'])->get();
        return view('retours.index', compact('retours'));
    }

    
    public function create()
    {
        $commandes = CommandeClient::all();
        $produits = Produits::all();
        $regions = regions::all();
        $employes = employes::all();
        return view('retours.create', compact('commandes', 'produits', 'regions', 'employes'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'commande_client_id' => 'required',
            'produit_id' => 'required',
            'quantite' => 'required|numeric|min:1',
            'date_retour' => 'required|date',
            'motif' => 'required',
            'comptable_id' => 'required',
            'region_id' => 'required',
            'notes' => 'nullable',
        ]);

        Retours::create($req->all());
        return to_route('retours.index')->with('success', 'Retour créé avec succès');
    }

    public function show(Retours $retour)
    {
        $retour->load(['commande_client', 'produit', 'comptable', 'region']);
        return view('retours.show', compact('retour'));
    }

    
    public function edit(Retours $retour)
    {
        $commandes = CommandeClient::all();
        $produits = Produits::all();
        $regions = regions::all();
        $employes = employes::all();
        return view('retours.edit', compact('retour', 'commandes', 'produits', 'regions', 'employes'));
    }


    public function update(Request $req, Retours $retour)
    {
        $req->validate([
            'commande_client_id' => 'required',
            'produit_id' => 'required',
            'quantite' => 'required|numeric|min:1',
            'date_retour' => 'required|date',
            'motif' => 'required',
            'comptable_id' => 'required',
            'region_id' => 'required',
            'notes' => 'nullable',
        ]);

        $retour->update($req->all());
        return to_route('retours.index')->with('success', 'Retour modifié avec succès');
    }

    
    public function destroy(Retours $retour)
    {
        $retour->delete();
        return to_route('retours.index')->with('success', 'Retour supprimé avec succès');
    }
}
