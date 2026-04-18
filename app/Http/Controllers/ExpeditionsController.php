<?php

namespace App\Http\Controllers;

use App\Models\employes;
use App\Models\Expeditions;
use Illuminate\Http\Request;

class ExpeditionsController extends Controller
{
    public function index(Request $req)
    {
        $search = $req->input('search');
        $query = Expeditions::with(['employes', 'commandesClients']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('numero_camion', 'like', "%$search%")
                    ->orWhereHas('employes', function ($q2) use ($search) {
                        $q2->where('nom_complet', 'like', "%$search%");
                    })
                    ->orWhereHas('commandesClients', function ($q2) use ($search) {
                        $q2->where('numero_commande', 'like', "%$search%")
                            ->orWhere('id', 'like', "%$search%");
                    });
            });
        }

        $expeditions = $query->orderBy('id', 'desc')->get();
        return view("expeditions.index", compact("expeditions", "search"));
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

    public function show(Request $request, Expeditions $expedition)
    {
        $search = $request->input('search');
        $expedition->load(['employes', 'commandesClients' => function($query) use ($search) {
            $query->with('client');
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('numero_commande', 'like', "%$search%")
                      ->orWhereHas('client', function($q2) use ($search) {
                          $q2->where('nom_entreprise', 'like', "%$search%");
                      });
                });
            }
        }]);
        
        return view('expeditions.show', compact('expedition', 'search'));
    }

    public function edit(Expeditions $expedition)
    {
        if ($expedition->statut_livraison === 'Livré' || $expedition->statut_livraison === 'Livrée') {
            return back()->with('error', 'Impossible de modifier une expédition déjà validée.');
        }
        $chauffeurs = employes::all();
        return view('expeditions.edit', compact('expedition', 'chauffeurs'));
    }

    public function update(Request $req, Expeditions $expedition)
    {
        if ($expedition->statut_livraison === 'Livré' || $expedition->statut_livraison === 'Livrée') {
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
        if ($expedition->statut_livraison === 'Livré' || $expedition->statut_livraison === 'Livrée') {
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

        // Valider aussi les commandes associées
        foreach ($expedition->commandesClients as $commande) {
            $commande->update([
                'statut' => 'Livrée'
            ]);
        }

        return to_route('expeditions.index')->with('success', 'Expédition et commandes associées validées avec succès.');
    }}