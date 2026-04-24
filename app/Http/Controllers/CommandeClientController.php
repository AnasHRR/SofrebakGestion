<?php

namespace App\Http\Controllers;

use App\Models\CommandeClient;
use App\Models\clients;
use App\Models\Produits;
use App\Models\detailsCommandeClients;
use App\Models\employes;
use App\Models\Expeditions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommandeClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CommandeClient::with(['client', 'expedition']);

        if ($request->filled('numero_commande')) {
            $query->where('numero_commande', 'like', '%' . $request->numero_commande . '%');
        }

        if ($request->filled('date_commande')) {
            $query->whereDate('date_commande', $request->date_commande);
        }

        // Calcul des stats avant de masquer les livrées
        $allResultsForStats = $query->get();
        $stats = [
            'total' => $allResultsForStats->count(),
            'livrees' => $allResultsForStats->whereIn('statut', ['Livrée', 'Livré'])->count(),
            'en_cours' => $allResultsForStats->whereIn('statut', ['Nouvelle', 'En préparation', 'Expédiée'])->count(),
            'montant_total' => $allResultsForStats->sum('montant_total'),
        ];

        $showValidated = $request->boolean('show_validated');
        if (!$showValidated) {
            $query->where(function($q) {
                $q->where('statut', '!=', 'Livrée')
                  ->where('statut', '!=', 'Livré')
                  ->orWhereNull('statut');
            });
        }

        $commandeClient = $query->orderBy('id', 'desc')->get();

        return view('commandes.index', compact('commandeClient', 'showValidated', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = clients::all();
        $produits = Produits::all();
        $commandeClient = CommandeClient::all();
        $employes = employes::where('poste', 'Comptable')->get();
        // Just the expeditions not validated
        $expeditions = Expeditions::with('employes')
            ->whereNotIn('statut_livraison', ['Livré', 'Livrée'])
            ->get();
        return view('commandes.create', compact('clients', 'produits', 'employes', 'commandeClient', 'expeditions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $validatedData = $req->validate([
            'numero_commande' => 'required|string|max:255',
            'date_commande' => 'required|date',
            'client_id' => 'required|exists:clients,id',
            'comptable_id' => 'nullable|integer',
            'date_livraison' => 'nullable|date',
            'statut' => 'nullable|string|max:255',
            'statut_paiement' => 'nullable|string|max:255',
            'montant_total' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'expedition_id' => 'nullable|exists:expeditions,id',
            'produits' => 'required|array|min:1',
            'produits.*.produit_id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
            'produits.*.prix_unitaire' => 'required|numeric|min:0',
            'produits.*.remise' => 'nullable|numeric|min:0',
        ]);

        // ── Stock validation: prevent selling more than available ──
        foreach ($validatedData['produits'] as $index => $produitData) {
            $produitModel = Produits::findOrFail($produitData['produit_id']);
            if ($produitData['quantite'] > $produitModel->stock_actuel) {
                return back()->withInput()->withErrors([
                    "produits.{$index}.quantite" => "Stock insuffisant pour \"{$produitModel->nom_produit}\". Disponible: {$produitModel->stock_actuel}, demandé: {$produitData['quantite']}."
                ]);
            }
        }

        DB::beginTransaction();
        try {
            $dateLivraison = $validatedData['date_livraison'] ?? null;
            $statut = $validatedData['statut'] ?? 'Nouvelle';
            if (!empty($validatedData['expedition_id'])) {
                $exped = Expeditions::find($validatedData['expedition_id']);
                if ($exped) {
                    $dateLivraison = $exped->date_expedition;
                    $statut = 'Expédiée';
                }
            }

            $commande = CommandeClient::create([
                'numero_commande' => $validatedData['numero_commande'],
                'date_commande' => $validatedData['date_commande'],
                'client_id' => $validatedData['client_id'],
                'comptable_id' => $validatedData['comptable_id'] ?? null,
                'date_livraison' => $dateLivraison,
                'statut' => $statut,
                'statut_paiement' => $validatedData['statut_paiement'] ?? 'Non payé',
                'montant_total' => $validatedData['montant_total'] ?? 0,
                'notes' => $validatedData['notes'] ?? null,
                'expedition_id' => $validatedData['expedition_id'] ?? null,
            ]);

            foreach ($validatedData['produits'] as $produit) {
                $remise = $produit['remise'] ?? 0;
                $commande->details()->create([
                    'produit_id' => $produit['produit_id'],
                    'quantite' => $produit['quantite'],
                    'prix_unitaire' => $produit['prix_unitaire'],
                    'remise' => $remise,
                    'prix_total' => max(0, ($produit['quantite'] * $produit['prix_unitaire']) * (1 - $remise / 100)),
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Erreur lors de l\'enregistrement de la commande: ' . $e->getMessage()]);
        }

        return to_route('commandes.index')->with('success', 'Commande créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $commandeClient = CommandeClient::findOrFail($id);
        $clients = clients::all();
        $employes = employes::where('poste', 'Comptable')->get();
        return view('commandes.show', compact('commandeClient', 'clients', 'employes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $commandeClient = CommandeClient::with('details')->findOrFail($id);
        if ($commandeClient->statut === 'Livrée' || $commandeClient->statut === 'Livré') {
            return back()->with('error', 'Impossible de modifier une commande déjà livrée.');
        }
        $clients = clients::all();
        $produits = Produits::all();
        $employes = employes::where('poste', 'Comptable')->get();
        
        $expeditions = Expeditions::with('employes')
            ->whereNotIn('statut_livraison', ['Livré', 'Livrée'])
            ->orWhere('id', $commandeClient->expedition_id)
            ->get();
            
        return view('commandes.edit', compact('commandeClient', 'clients', 'produits', 'employes', 'expeditions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $commandeClient = CommandeClient::findOrFail($id);

        if ($commandeClient->statut === 'Livrée' || $commandeClient->statut === 'Livré') {
            return back()->with('error', 'Impossible de modifier une commande déjà livrée.');
        }

        $validatedData = $request->validate([
            'numero_commande' => 'required|string|max:255',
            'date_commande' => 'required|date',
            'client_id' => 'required|exists:clients,id',
            'comptable_id' => 'nullable|integer',
            'date_livraison' => 'nullable|date',
            'statut' => 'nullable|string|max:255',
            'statut_paiement' => 'nullable|string|max:255',
            'montant_total' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'expedition_id' => 'nullable|exists:expeditions,id',
            'produits' => 'required|array|min:1',
            'produits.*.produit_id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
            'produits.*.prix_unitaire' => 'required|numeric|min:0',
            'produits.*.remise' => 'nullable|numeric|min:0',
        ]);

        // ── Stock validation for update ──
        // When updating, old detail lines will be deleted first, so we simulate
        // the stock as if the old order didn't exist, then check the new quantities.
        $oldDetails = detailsCommandeClients::where('commande_client_id', $commandeClient->id)->get();

        foreach ($validatedData['produits'] as $index => $produitData) {
            $produitModel = Produits::findOrFail($produitData['produit_id']);
            // Add back the old quantity for this product (since old lines will be deleted)
            $oldQty = $oldDetails->where('produit_id', $produitData['produit_id'])->sum('quantite');
            $availableStock = $produitModel->stock_actuel + $oldQty;

            if ($produitData['quantite'] > $availableStock) {
                return back()->withInput()->withErrors([
                    "produits.{$index}.quantite" => "Stock insuffisant pour \"{$produitModel->nom_produit}\". Disponible: {$availableStock}, demandé: {$produitData['quantite']}."
                ]);
            }
        }

        DB::beginTransaction();
        try {
            $dateLivraison = $validatedData['date_livraison'] ?? $commandeClient->date_livraison;
            $statut = $validatedData['statut'] ?? $commandeClient->statut;

            if (!empty($validatedData['expedition_id'])) {
                $exped = Expeditions::find($validatedData['expedition_id']);
                if ($exped) {
                    $dateLivraison = $exped->date_expedition;
                    $statut = 'Expédiée';
                }
            } else {
                // Si l'expédition est retirée alors qu'elle existait
                if ($commandeClient->expedition_id && empty($validatedData['expedition_id'])) {
                    $statut = 'En préparation';
                    $dateLivraison = null;
                }
            }

            $commandeClient->update([
                'numero_commande' => $validatedData['numero_commande'],
                'date_commande' => $validatedData['date_commande'],
                'client_id' => $validatedData['client_id'],
                'comptable_id' => $validatedData['comptable_id'] ?? null,
                'date_livraison' => $dateLivraison,
                'statut' => $statut,
                'statut_paiement' => $validatedData['statut_paiement'] ?? 'Non payé',
                'montant_total' => $validatedData['montant_total'] ?? 0,
                'notes' => $validatedData['notes'] ?? null,
                'expedition_id' => $validatedData['expedition_id'] ?? null,
            ]);

            detailsCommandeClients::where('commande_client_id', $commandeClient->id)->delete();

            foreach ($validatedData['produits'] as $produit) {
                $remise = $produit['remise'] ?? 0;
                detailsCommandeClients::create([
                    'commande_client_id' => $commandeClient->id,
                    'produit_id' => $produit['produit_id'],
                    'quantite' => $produit['quantite'],
                    'prix_unitaire' => $produit['prix_unitaire'],
                    'remise' => $remise,
                    'prix_total' => max(0, ($produit['quantite'] * $produit['prix_unitaire']) * (1 - $remise / 100)),
                ]);
            }

            DB::commit();        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Erreur lors de la mise à jour de la commande: ' . $e->getMessage()]);
        }

        return to_route('commandes.index')->with('success', 'Commande mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $commandeClient = CommandeClient::with('details')->findOrFail($id);
        if ($commandeClient->statut === 'Livrée' || $commandeClient->statut === 'Livré') {
            return back()->with('error', 'Impossible de supprimer une commande déjà livrée.');
        }

        DB::beginTransaction();
        try {
            $commandeClient->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }

        return to_route('commandes.index')->with('success', 'Commande supprimée avec succès.');
    }
}