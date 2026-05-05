<?php

namespace App\Http\Controllers;

use App\Models\commandesFournisseurs;
use App\Models\fournisseurs;
use App\Models\employes;
use Illuminate\Http\Request;

class CommandesFournisseursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commandes = commandesFournisseurs::with(['fournisseur', 'employe'])->orderBy('id', 'desc')->get();
        return view('commandesFournisseurs.index' , compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fournisseurs = fournisseurs::all();
        $employes = employes::all();
        return view('commandesFournisseurs.create' , compact('fournisseurs', 'employes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'date_commande' => 'required|date',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'employe_id' => 'required|exists:employes,id',
            'statut' => 'required',
            'montant_total' => 'required|numeric',
            'notes' => 'nullable',
        ]);

        commandesFournisseurs::create($req->all());

        return to_route('commandesFournisseurs.index')->with('success', 'Commande ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $commandesFournisseur = commandesFournisseurs::with(['fournisseur', 'employe'])->findOrFail($id);
        return view('commandesFournisseurs.show' , compact('commandesFournisseur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $commandesFournisseur = commandesFournisseurs::findOrFail($id);
        $fournisseurs = fournisseurs::all();
        $employes = employes::all();
        return view("commandesFournisseurs.edit" , compact('commandesFournisseur', 'fournisseurs', 'employes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, $id)
    {
        $commandesFournisseur = commandesFournisseurs::findOrFail($id);
        $req->validate([
            'date_commande' => 'required|date',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'employe_id' => 'required|exists:employes,id',
            'statut' => 'required',
            'montant_total' => 'required|numeric',
            'notes' => 'nullable',
        ]);

        $commandesFournisseur->update($req->all());

        return to_route('commandesFournisseurs.index')->with('success', 'Commande modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $commandesFournisseur = commandesFournisseurs::findOrFail($id);
        $commandesFournisseur->delete();
        return to_route('commandesFournisseurs.index')->with('success', 'Commande supprimée avec succès.');
    }
}
