<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Produits;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::with('produits')->orderBy('id', 'desc')->simplePaginate(10);
        return view('stock.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produits = Produits::all();
        return view('stock.create', compact('produits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'type_mouvement' => 'required|in:Entrée,Sortie,Ajustement',
            'quantite' => 'required|integer|min:1',
            'date_mouvement' => 'required|date',
            'reference_id' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Stock::create($request->all());

        return redirect()->route('stock.index')->with('success', 'Mouvement de stock ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        return view('stock.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        $produits = Produits::all();
        return view('stock.edit', compact('stock', 'produits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'type_mouvement' => 'required|in:Entrée,Sortie,Ajustement',
            'quantite' => 'required|integer|min:1',
            'date_mouvement' => 'required|date',
            'reference_id' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $stock->update($request->all());

        return redirect()->route('stock.index')->with('success', 'Mouvement de stock mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stock.index')->with('success', 'Mouvement de stock supprimé avec succès.');
    }
}
