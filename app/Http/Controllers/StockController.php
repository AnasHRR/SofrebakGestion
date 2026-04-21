<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Produits;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Affiche la liste des mouvements de stock.
     */
    public function index()
    {
        // Récupérer les stocks avec leurs produits associés pour éviter le problème N+1
        // On les trie du plus récent au plus ancien, avec une pagination simple de 10
        $stocks = Stock::with('produits')->orderBy('id', 'desc')->simplePaginate(10);
        
        // Retourner la vue contenant la liste
        return view('stock.index', compact('stocks'));
    }

    /**
     * Affiche le formulaire de création d'un mouvement de stock.
     */
    public function create()
    {
        // Récupérer tous les produits pour pouvoir les lister dans le menu déroulant
        $produits = Produits::all();
        
        // Retourner la vue du formulaire
        return view('stock.create', compact('produits'));
    }

    /**
     * Enregistre un nouveau mouvement de stock dans la base de données.
     */
    public function store(Request $req)
    {
        $req->validate([
            'produit_id' => 'required|exists:produits,id',
            'type_mouvement' => 'required|in:Entrée,Sortie,Ajustement',
            'quantite' => 'required|integer|min:1',
            'date_mouvement' => 'required|date',
            'reference_id' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Stock::create($req->all());

        return to_route('stock.index')->with('success', 'Mouvement de stock ajouté avec succès.');
    }

    /**
     * Affiche les détails d'un mouvement de stock spécifique.
     */
    public function show(Stock $stock)
    {
        return view('stock.show', compact('stock'));
    }

    /**
     * Affiche le formulaire pour modifier un mouvement de stock existant.
     */
    public function edit(Stock $stock)
    {
        $produits = Produits::all();
        return view('stock.edit', compact('stock', 'produits'));
    }

    /**
     * Met à jour le mouvement de stock spécifié dans la base de données.
     */
    public function update(Request $req, Stock $stock)
    {
        // 1. Validation des nouvelles données soumises
        $req->validate([
            'produit_id' => 'required|exists:produits,id',
            'type_mouvement' => 'required|in:Entrée,Sortie,Ajustement',
            'quantite' => 'required|integer|min:1',
            'date_mouvement' => 'required|date',
            'reference_id' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $stock->update($req->all());
        return to_route('stock.index')->with('success', 'Mouvement de stock mis à jour avec succès.');
    }

    /**
     * Supprime le mouvement de stock de la base de données.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return to_route('stock.index')->with('success', 'Mouvement de stock supprimé avec succès.');
    }
}
