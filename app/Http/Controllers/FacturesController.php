<?php

namespace App\Http\Controllers;

use App\Models\Factures;
use App\Models\CommandeClient;
use Illuminate\Http\Request;

class FacturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factures = Factures::all();
        return view("factures.index", compact("factures"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $commandes = CommandeClient::all();
        return view("factures.create", compact("commandes"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'commande_client_id' => 'required|exists:commandes_clients,id',
            'numero_facture' => 'required|string',
            'date_facture' => 'required|date',
            'date_echeance' => 'nullable|date',
            'date_reglement' => 'nullable|date',
            'sous_total' => 'required|numeric|min:0',
            'montant_tva' => 'required|numeric|min:0',
            'montant_total' => 'required|numeric|min:0',
            'montant_paye' => 'nullable|numeric|min:0',
            'statut' => 'required|string',
        ]);

        Factures::create($req->all());
        return to_route('factures.index')->with('success', 'Facture créer avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $facture = Factures::findOrFail($id);
        return view("factures.show", compact("facture"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $facture = Factures::findOrFail($id);
        $commandes = CommandeClient::all();
        return view("factures.edit", compact("facture", "commandes"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $req->validate([
            'commande_client_id' => 'required|exists:commandes_clients,id',
            'numero_facture' => 'required|string',
            'date_facture' => 'required|date',
            'date_echeance' => 'nullable|date',
            'date_reglement' => 'nullable|date',
            'sous_total' => 'required|numeric|min:0',
            'montant_tva' => 'required|numeric|min:0',
            'montant_total' => 'required|numeric|min:0',
            'montant_paye' => 'nullable|numeric|min:0',
            'statut' => 'required|string',
        ]);

        $facture = Factures::findOrFail($id);
        $facture->update($req->all());

        return to_route('factures.index')->with('success', 'Facture modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $facture = Factures::findOrFail($id);
        $facture->delete();
        return to_route('factures.index')->with('success', 'Facture supprimée avec succès.');
    }
}
