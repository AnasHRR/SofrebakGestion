<?php

namespace App\Http\Controllers;

use App\Models\clients;
use App\Models\regions;
use App\Models\CommandeClient;
use App\Models\Paiement;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        if ($search) {
            $clients = clients::where('nom_entreprise', 'like', "%{$search}%")
                ->orWhere('personne_contact', 'like', "%{$search}%")
                ->orWhere('telephone', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('adresse', 'like', "%{$search}%")
                ->orWhere('region_id', 'like', "%{$search}%")
                ->orWhere('plafond_credit', 'like', "%{$search}%")
                ->orderBy('id')
                ->simplePaginate(8);
        } else {
            $clients = clients::orderBy('id')->simplePaginate(8);
        }

        $total_clients = clients::count();
        
        $total_commandes = CommandeClient::where('statut', '!=', 'Annulée')->sum('montant_total');
        $total_paiements = Paiement::sum('montant');
        
        // Calcul du total des retours pour les commandes non annulées
        $total_retours = \App\Models\Retours::whereHas('commande_client', function($q) {
            $q->where('statut', '!=', 'Annulée');
        })->get()->sum('valeur');

        $total_credit = ($total_commandes - $total_retours) - $total_paiements;

        $region = regions::all();
        return view('clients.index', compact('clients' , 'region', 'total_clients' , 'total_credit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $region = regions::all();
        return view('clients.create' , compact('region'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'nom_entreprise' => 'required',
            'personne_contact' => 'required',
            'adresse' => 'required',
        ]);

        clients::create([
            'nom_entreprise' => $req->nom_entreprise,
            'personne_contact' => $req->personne_contact,
            'telephone' => $req->telephone,
            'email' => $req->email,
            'adresse' => $req->adresse,
            'region_id' => $req->region_id,
            'plafond_credit' => $req->plafond_credit,
        ]);
        return to_route('clients.index')->with('success','Ajouter avec success');
    }

    /**
     * Display the specified resource.
     */
    public function show(clients $client)
    {
        $client->load(['commandes', 'retours.produit']);
        return view('clients.show' , compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(clients $client)
    {
        $region = regions::all();
        return view('clients.edit' , compact('client', 'region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, clients $client)
    {
        $req->validate([
            'nom_entreprise' => 'required',
            'personne_contact' => 'required',
            'adresse' => 'required',
        ]);

        $client->update([
            'nom_entreprise' => $req->nom_entreprise,
            'personne_contact' => $req->personne_contact,
            'telephone' => $req->telephone,
            'email' => $req->email,
            'adresse' => $req->adresse,
            'region_id' => $req->region_id,
        ]);
        return to_route('clients.index')->with('success','Modifier avec success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(clients $client)
    {
        $client->delete();
        return to_route('clients.index')->with('success','Supprimer avec success');
    }
}