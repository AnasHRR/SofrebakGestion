<?php

namespace App\Http\Controllers;

use App\Models\Factures;
use App\Models\clients;
use Illuminate\Http\Request;

class FacturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factures = Factures::with('client')->get();
        return view("factures.index", compact("factures"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = clients::all()->filter(function($client) {
            return $client->total_paiements_attente > 0;
        });
        $produits = \App\Models\Produits::all();
        return view("factures.create", compact("clients", "produits"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'client_id' => 'required|exists:clients,id',
            'numero_facture' => 'required|string',
            'date_facture' => 'required|date',
            'date_echeance' => 'nullable|date',
            'date_reglement' => 'nullable|date',
            'sous_total' => 'required|numeric|min:0',
            'montant_tva' => 'required|numeric|min:0',
            'montant_total' => 'required|numeric|min:0',
            'montant_paye' => 'nullable|numeric|min:0|lte:montant_total',
            'statut' => 'required|string',
            'produits' => 'nullable|array',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function() use ($req) {
            $data = $req->all();
            if (empty($data['id'])) {
                $data['id'] = (string) \Illuminate\Support\Str::uuid();
            }
            $facture = Factures::create($data);

            // Validate the client's payments that were used for this facture
            \App\Models\Paiement::where('client_id', $req->client_id)
                ->where('statut', 'En attente')
                ->update(['statut' => 'Validé']);

            if ($req->has('produits')) {
                foreach ($req->produits as $item) {
                    \App\Models\FactureDetail::create([
                        'facture_id' => $facture->id,
                        'produit_id' => $item['produit_id'],
                        'quantite' => $item['quantite'],
                        'prix_unitaire' => $item['prix_unitaire'],
                        'total' => $item['total'],
                    ]);
                }
            }
        });

        return to_route('factures.index')->with('success', 'Facture créer avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $facture = Factures::with(['client', 'details.produit'])->findOrFail($id);
        return view("factures.show", compact("facture"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $facture = Factures::findOrFail($id);
        $clients = clients::all();
        $produits = \App\Models\Produits::all();
        return view("factures.edit", compact("facture", "clients", "produits"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $req->validate([
            'client_id' => 'required|exists:clients,id',
            'numero_facture' => 'required|string',
            'date_facture' => 'required|date',
            'date_echeance' => 'nullable|date',
            'date_reglement' => 'nullable|date',
            'sous_total' => 'required|numeric|min:0',
            'montant_tva' => 'required|numeric|min:0',
            'montant_total' => 'required|numeric|min:0',
            'montant_paye' => 'nullable|numeric|min:0|lte:montant_total',
            'statut' => 'required|string',
            'produits' => 'nullable|array',
        ]);

        $facture = Factures::findOrFail($id);
        
        \Illuminate\Support\Facades\DB::transaction(function() use ($req, $facture) {
            $facture->update($req->all());

            // Delete old details
            $facture->details()->delete();

            if ($req->has('produits')) {
                foreach ($req->produits as $item) {
                    \App\Models\FactureDetail::create([
                        'facture_id' => $facture->id,
                        'produit_id' => $item['produit_id'],
                        'quantite' => $item['quantite'],
                        'prix_unitaire' => $item['prix_unitaire'],
                        'total' => $item['total'],
                    ]);
                }
            }
        });

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
