<?php

namespace App\Http\Controllers;

use App\Models\categories_produits;
use Illuminate\Http\Request;

class CategoriesProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        
        if ($search) {
            $categories = categories_produits::where('nom', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->get();
        } else {
            $categories = categories_produits::all();
        }

        return view("categories_produits.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("categories_produits.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:categories_produits,id',
            'nom' => 'required',
            'description' => 'required'
        ]);

        categories_produits::create([
            'id' => $request->id,
            'nom' => $request->nom,
            'description' => $request->description
        ]);

        return to_route('categories.index')->with('success', 'Catégorie ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return to_route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = categories_produits::findOrFail($id);
        return view('categories_produits.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, $id)
    {
        $req->validate([
            'nom' => 'required',
            'description' => 'required'
        ]);

        $categorie = categories_produits::findOrFail($id);
        $categorie->update([
            'nom' => $req->nom,
            'description' => $req->description
        ]);

        return to_route('categories.index')->with('success', 'Catégorie modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categorie = categories_produits::findOrFail($id);
        $categorie->delete();

        return to_route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}