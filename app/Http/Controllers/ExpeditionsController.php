<?php

namespace App\Http\Controllers;

use App\Models\CommandeClient;
use App\Models\employes;
use App\Models\Expeditions;
use Illuminate\Http\Request;

class ExpeditionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expeditions = Expeditions::with(['commandeClient', 'employes'])->get();
        return view("expeditions.index", compact("expeditions"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $commandesClients = CommandeClient::where('statut', '!=', 'Livrée')->get();
        $chauffeurs = employes::where('poste', 'Chauffeur')->get();
        // Fallback for chauffeurs if empty
        if ($chauffeurs->isEmpty()) {
            $chauffeurs = employes::all();
        }
        $expeditions = Expeditions::all();
        return view("expeditions.create", compact("commandesClients", "chauffeurs", "expeditions"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req , Expeditions $expedition)
    {
        $req->validate([
            'commande_client_id' => 'required',
            'chauffeur_id' => 'required',
            'date_expedition' => 'required',
            'numero_camion' => 'required',
            'statut_livraison' => 'required',
        ]);

        $expedition->create($req->all());

        return to_route('expeditions.index')->with('success', 'Expedition ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expeditions $expedition)
    {
        return view('expeditions.show', compact('expedition'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expeditions $expedition)
    {
        $commandesClients = CommandeClient::all();
        $chauffeurs = employes::all();
        return view('expeditions.edit', compact('expedition', 'commandesClients', 'chauffeurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Expeditions $expedition)
    {
        $req->validate([
            'commande_client_id' => 'required',
            'chauffeur_id' => 'required',
            'date_expedition' => 'required|date',
            'numero_camion' => 'required',
            'statut_livraison' => 'required',
        ]);

        $expedition->update([
            'commande_client_id' => $req->commande_client_id,
            'chauffeur_id' => $req->chauffeur_id,
            'date_expedition' => $req->date_expedition,
            'numero_camion' => $req->numero_camion,
            'statut_livraison' => $req->statut_livraison,
            'notes_livraison' => $req->notes_livraison,
        ]);

        return redirect()->route('expeditions.index')->with('success', 'Expedition modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expeditions $expedition)
    {
        $expedition->delete();
        return redirect()->route('expeditions.index')->with('success', 'Expedition supprimée avec succès.');
    }

    /**
     * Valider après livrer
     */
    public function valider($id)
    {
        $expedition = Expeditions::findOrFail($id);
        
        $expedition->update([
            'statut_livraison' => 'Livré'
        ]);

        if ($expedition->commande_client_id) {
            $commande = \App\Models\CommandeClient::find($expedition->commande_client_id);
            if ($commande) {
                $commande->update([
                    'statut' => 'Livrée' // or any delivered status you have
                ]);
            }
        }

        return redirect()->route('expeditions.index')->with('success', 'Expedition validée avec succès.');
    }
}
