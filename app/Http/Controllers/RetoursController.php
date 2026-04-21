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
            'commande_client_id' => 'required|exists:commandes_clients,id',
            'date_retour' => 'required|date',
            'comptable_id' => 'required',
            'region_id' => 'required',
            'produits' => 'required|array|min:1',
            'produits.*.produit_id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|numeric|min:1',
            'produits.*.motif' => 'required|in:Endommagé,Périmé,Non conforme,Autre',
            'produits.*.notes' => 'nullable',
        ]);

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            foreach ($req->produits as $index => $prod) {
                // Find the detail in the command
                $detail = \App\Models\detailsCommandeClients::where('commande_client_id', $req->commande_client_id)
                    ->where('produit_id', $prod['produit_id'])
                    ->first();

                if (!$detail) {
                    throw new \Exception("Le produit ID " . $prod['produit_id'] . " n'existe pas dans cette commande.");
                }

                if ($prod['quantite'] > $detail->quantite) {
                    throw new \Exception("La quantité retournée (" . $prod['quantite'] . ") pour le produit " . ($detail->produit->nom_produit ?? $prod['produit_id']) . " est supérieure à la quantité commandée (" . $detail->quantite . ").");
                }

                // Create the return record
                Retours::create([
                    'commande_client_id' => $req->commande_client_id,
                    'date_retour' => $req->date_retour,
                    'comptable_id' => $req->comptable_id,
                    'region_id' => $req->region_id,
                    'produit_id' => $prod['produit_id'],
                    'quantite' => $prod['quantite'],
                    'motif' => $prod['motif'],
                    'notes' => $prod['notes'],
                ]);

                // Update command details
                if ($prod['quantite'] == $detail->quantite) {
                    $detail->delete();
                } else {
                    $detail->quantite -= $prod['quantite'];
                    // Recalculate prix_total for the detail row
                    // prix_total = (qty * unit_price) * (1 - remise/100)
                    $detail->prix_total = ($detail->quantite * $detail->prix_unitaire) * (1 - ($detail->remise ?? 0) / 100);
                    $detail->save();
                }
            }

            // Recalculate total amount of the command
            $commande = CommandeClient::find($req->commande_client_id);
            $newTotal = $commande->details()->sum('prix_total');
            $commande->montant_total = $newTotal;
            $commande->save();

            \Illuminate\Support\Facades\DB::commit();
            return to_route('retours.index')->with('success', 'Retours enregistrés et commande mise à jour avec succès');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
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
            'motif' => 'required|in:Endommagé,Périmé,Non conforme,Autre',
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

    public function getProduits($commandeId)
    {
        $commande = CommandeClient::with('details.produit')->find($commandeId);
        if (!$commande) {
            return response()->json([]);
        }

        $produits = $commande->details->map(function ($detail) {
            return [
                'id' => $detail->produit->id,
                'nom_produit' => $detail->produit->nom_produit
            ];
        });

        return response()->json($produits);
    }
}
