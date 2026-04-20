<?php

namespace App\Http\Controllers;

use App\Models\clients;
use App\Models\employes;
use App\Models\Paiement;
use App\Models\regions;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paiements = Paiement::all();
        return view('paiements.index', compact('paiements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()   
    {
        $clients = clients::all();
        $comptables = employes::where('poste', 'Comptable')->get();
        $regions = regions::all();
        return view('paiements.create', compact('clients', 'comptables', 'regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req, Paiement $paiement)
    {
        $req->validate([
            'client_id' => 'required',
            'comptable_id' => 'required',
            'montant' => 'required',
            'date_paiement' => 'required',
            'mode_paiement' => 'required',
            'region_id' => 'required',
            'notes' => 'required',
        ]);

        $paiement->create($req->all());

        return to_route('paiements.index')->with('success', 'Paiement ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paiement $paiement)
    {
        return view('paiements.show', compact('paiement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paiement $paiement)
    {
        $clients = clients::all();
        $comptables = employes::where('poste', 'Comptable')->get();
        $regions = regions::all();
        return view('paiements.edit', compact('paiement', 'clients', 'comptables', 'regions'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Paiement $paiement)
    {
        $req->validate([
            'client_id' => 'required',
            'comptable_id' => 'required',
            'montant' => 'required',
            'date_paiement' => 'required',
            'mode_paiement' => 'required',
            'region_id' => 'required',
            'notes' => 'required',
        ]);

        $paiement->update($req->all());

        return to_route('paiements.index')->with('success', 'Paiement modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paiement $paiement)
    {
        $paiement->delete();
        return to_route('paiements.index')->with('success', 'Paiement supprimé avec succès');
    }
}
