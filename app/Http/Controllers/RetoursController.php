<?php

namespace App\Http\Controllers;

use App\Models\Retours;
use App\Models\CommandeClient;
use App\Models\Produits;
use App\Models\regions;
use App\Models\employes;
use App\Models\Stock;
use App\Models\detailsCommandeClients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        DB::beginTransaction();
        try {
            foreach ($req->produits as $index => $prod) {
                // Find the detail in the command
                $detail = detailsCommandeClients::where('commande_client_id', $req->commande_client_id)
                    ->where('produit_id', $prod['produit_id'])
                    ->first();

                if (!$detail) {
                    throw new \Exception("Le produit ID " . $prod['produit_id'] . " n'existe pas dans cette commande.");
                }

                // Calculate total quantity already returned for this product in this command
                $dejaRetourne = Retours::where('commande_client_id', $req->commande_client_id)
                    ->where('produit_id', $prod['produit_id'])
                    ->sum('quantite');

                if (($prod['quantite'] + $dejaRetourne) > $detail->quantite) {
                    throw new \Exception("La quantité totale retournée (" . ($prod['quantite'] + $dejaRetourne) . ") pour le produit " . ($detail->produit->nom_produit ?? $prod['produit_id']) . " est supérieure à la quantité commandée (" . $detail->quantite . ").");
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

                // Create stock movement for visibility and history
                Stock::create([
                    'produit_id' => $prod['produit_id'],
                    'type_mouvement' => 'Retour',
                    'quantite' => $prod['quantite'],
                    'date_mouvement' => $req->date_retour,
                    'reference_id' => 'RETOUR-' . $req->commande_client_id,
                    'notes' => 'Retour Client - Commande #' . $req->commande_client_id . ' - Motif: ' . $prod['motif']
                ]);
            }

            // Update command total amount
            $this->updateCommandeTotal($req->commande_client_id);

            DB::commit();
            return to_route('retours.index')->with('success', 'Retours enregistrés et stock mis à jour avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function show(Retours $retour)
    {
        $retour->load(['commande_client.client', 'produit', 'comptable', 'region']);
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

        DB::beginTransaction();
        try {
            // Update associated stock movement if it exists
            $stock = Stock::where('reference_id', 'RETOUR-' . $retour->commande_client_id)
                ->where('produit_id', $retour->produit_id)
                ->where('quantite', $retour->quantite)
                ->where('date_mouvement', $retour->date_retour)
                ->first();

            if ($stock) {
                $stock->update([
                    'produit_id' => $req->produit_id,
                    'quantite' => $req->quantite,
                    'date_mouvement' => $req->date_retour,
                    'notes' => 'Retour Client (Modifié) - Commande #' . $req->commande_client_id . ' - Motif: ' . $req->motif
                ]);
            }

            $retour->update($req->all());
            
            // Update command total
            $this->updateCommandeTotal($retour->commande_client_id);

            DB::commit();
            return to_route('retours.index')->with('success', 'Retour modifié avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    
    public function destroy(Retours $retour)
    {
        DB::beginTransaction();
        try {
            // Delete associated stock movement
            Stock::where('reference_id', 'RETOUR-' . $retour->commande_client_id)
                ->where('produit_id', $retour->produit_id)
                ->where('quantite', $retour->quantite)
                ->where('date_mouvement', $retour->date_retour)
                ->delete();

            $commandeId = $retour->commande_client_id;
            $retour->delete();

            // Update command total
            $this->updateCommandeTotal($commandeId);

            DB::commit();
            return to_route('retours.index')->with('success', 'Retour supprimé avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
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

    /**
     * Helper to update the total amount of a command based on its details and returns.
     */
    private function updateCommandeTotal($commandeId)
    {
        $commande = CommandeClient::with('details')->find($commandeId);
        if (!$commande) return;

        $totalOriginal = $commande->details->sum('prix_total');
        
        $totalRetours = 0;
        $allRetours = Retours::where('commande_client_id', $commandeId)->get();
        
        foreach ($allRetours as $r) {
            $detail = $commande->details->where('produit_id', $r->produit_id)->first();
            if ($detail) {
                $prixUnitaireNet = $detail->prix_unitaire * (1 - ($detail->remise ?? 0) / 100);
                $totalRetours += $r->quantite * $prixUnitaireNet;
            }
        }

        $commande->montant_total = $totalOriginal - $totalRetours;
        $commande->save();
    }
}
