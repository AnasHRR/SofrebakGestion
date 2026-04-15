<?php

namespace App\Http\Controllers;

use App\Models\employes;
use App\Models\Expeditions;
use Illuminate\Http\Request;

class ExpeditionsController extends Controller
{
    public function index()
    {
        $expeditions = Expeditions::with(['employes'])->get();
        return view("expeditions.index", compact("expeditions"));
    }

    public function create()
    {
        $chauffeurs = employes::where('poste', 'Chauffeur')->get();
        // Fallback for chauffeurs if empty
        if ($chauffeurs->isEmpty()) {
            $chauffeurs = employes::all();
        }
        $expeditions = Expeditions::all();
        return view("expeditions.create", compact("chauffeurs", "expeditions"));
    }

    public function store(Request $req , Expeditions $expedition)
    {
        $req->validate([
            'chauffeur_id' => 'required',
            'date_expedition' => 'required',
            'numero_camion' => 'required',
            'statut_livraison' => 'required',
        ]);

        $expedition->create($req->all());

        return to_route('expeditions.index')->with('success', 'Expedition ajoutée avec succès.');
    }

    public function show(Expeditions $expedition)
    {
        $expedition->load('employes', 'commandesClients.client');
        return view('expeditions.show', compact('expedition'));
    }

    public function edit(Expeditions $expedition)
    {
        if ($expedition->statut_livraison === 'Livré') {
            return back()->with('error', 'Impossible de modifier une expédition déjà validée.');
        }
        $chauffeurs = employes::all();
        return view('expeditions.edit', compact('expedition', 'chauffeurs'));
    }

    public function update(Request $req, Expeditions $expedition)
    {
        if ($expedition->statut_livraison === 'Livré') {
            return back()->with('error', 'Impossible de modifier une expédition déjà validée.');
        }
        $req->validate([
            'chauffeur_id' => 'required',
            'date_expedition' => 'required|date',
            'numero_camion' => 'required',
            'statut_livraison' => 'required',
        ]);

        $expedition->update([
            'chauffeur_id' => $req->chauffeur_id,
            'date_expedition' => $req->date_expedition,
            'numero_camion' => $req->numero_camion,
            'statut_livraison' => $req->statut_livraison,
            'notes_livraison' => $req->notes_livraison,
        ]);

        return to_route('expeditions.index')->with('success', 'Expedition modifiée avec succès.');
    }

    public function destroy(Expeditions $expedition)
    {
        if ($expedition->statut_livraison === 'Livré') {
            return back()->with('error', 'Impossible de supprimer une expédition déjà validée.');
        }
        $expedition->delete();
        return to_route('expeditions.index')->with('success', 'Expedition supprimée avec succès.');
    }

    public function valider($id)
    {
        $expedition = Expeditions::with('commandesClients')->findOrFail($id);
        
        $expedition->update([
            'statut_livraison' => 'Livrée'
        ]);

        return to_route('expeditions.index')->with('success', 'Expédition et commandes associées validées avec succès.');
    }
}