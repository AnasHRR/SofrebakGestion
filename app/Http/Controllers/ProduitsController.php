<?php

namespace App\Http\Controllers;

use App\Models\categories_produits;
use App\Models\fournisseurs;
use App\Models\Produits;
use Illuminate\Http\Request;

class ProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        // ── Recherche ──
        $query = Produits::query();

        $search = $req->search;

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nom_produit', 'like', "%{$search}%")
                  ->orWhere('prix_achat', 'like', "%{$search}%")
                  ->orWhere('prix_vente', 'like', "%{$search}%")
                  // search in category name
                  ->orWhereHas('categorie', function ($q2) use ($search) {
                      $q2->where('nom', 'like', "%{$search}%");
                  })
                  // search in fournisseur name
                  ->orWhereHas('fournisseur', function ($q3) use ($search) {
                      $q3->where('nom', 'like', "%{$search}%");
                  });
            });
        }

        $produits = $query->orderBy('id')->cursorPaginate(5);

        // ── Stats (computed from the accessor) ──
        $allProduits = Produits::all();
        $totalProduits = $allProduits->count();
        $totalEnStock = $allProduits->filter(fn($p) => $p->stock_actuel > 0)->count();
        $totalRupture = $allProduits->filter(fn($p) => $p->stock_actuel <= 0)->count();
        $valeurTotaleStock = $allProduits->sum(fn($p) => $p->prix_vente * $p->stock_actuel);

        $fournisseurs = fournisseurs::all();
        $categories = categories_produits::all();
        return view('produits.index', compact(
            'produits' , 
            'categories' , 
            'fournisseurs',
            'totalProduits',
            'totalEnStock',
            'totalRupture',
            'valeurTotaleStock'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = categories_produits::all();
        $fournisseurs = fournisseurs::all();
        return view('produits.create', compact('categories', 'fournisseurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        // Validate the request
        $req->validate([
            'nom_produit' => 'required',
            'categorie_id' => 'required',
            'fournisseur_id' => 'required',
            'unite' => 'required',
            'prix_achat' => 'required|numeric',
            'prix_vente' => 'required|numeric',
            'stock_minimum'=> 'required|numeric',
            'stock_initial' => 'required|numeric',
            'date_expiration' => 'required|date',
            'img_pr' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($req->hasFile('img_pr')) {
            $imageName = time().'.'.$req->img_pr->extension();
            $req->img_pr->move(public_path('images/produits'), $imageName);
            $imagePath = 'images/produits/' . $imageName;
        }
    
        // Create the product
        Produits::create([
            'nom_produit' => $req->nom_produit,   
            'categorie_id'    => $req->categorie_id,
            'fournisseur_id'  => $req->fournisseur_id,
            'img_pr'          => $imagePath,
            'unite'           => $req->unite,
            'prix_achat'      => $req->prix_achat,
            'prix_vente'      => $req->prix_vente,
            'stock_minimum'   => $req->stock_minimum,
            'stock_initial'   => $req->stock_initial,
            'date_expiration' => $req->date_expiration,
        ]);
    
        // Redirect with success message
        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produits $produit , fournisseurs $fournisseur , categories_produits $categorie)
    {
        return view('produits.show', compact('produit' ,'fournisseur','categorie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produits $produit)
    {
        $categories = categories_produits::all();
        $fournisseurs = fournisseurs::all();
        return view('produits.edit', compact('produit', 'categories', 'fournisseurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Produits $produit)
    {
        $req->validate([
            'categorie_id' => 'required',
            'fournisseur_id' => 'required',
            'unite' => 'required',
            'prix_achat' => 'required',
            'prix_vente' => 'required',
            'stock_minimum' => 'required',
            'stock_initial' => 'required',
            'img_pr' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $produit->img_pr;
        if ($req->hasFile('img_pr')) {
            // Delete old image if exists
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
            
            $imageName = time().'.'.$req->img_pr->extension();
            $req->img_pr->move(public_path('images/produits'), $imageName);
            $imagePath = 'images/produits/' . $imageName;
        }

        $produit->update([
            'nom_produit' => $req->nom_produit,
            'categorie_id' => $req->categorie_id,
            'fournisseur_id' => $req->fournisseur_id,
            'img_pr' => $imagePath,
            'unite' => $req->unite,
            'prix_achat' => $req->prix_achat,
            'prix_vente' => $req->prix_vente,
            'stock_minimum' => $req->stock_minimum,
            'stock_initial' => $req->stock_initial,
            'date_expiration' => $req->date_expiration,
        ]);
        return to_route('produits.index')->with('success','Modifier avec success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produits $produit)
    {
        // stock_actuel is now computed via the accessor
        if ($produit->stock_actuel > 0) {
            return to_route('produits.index')->with('alert', 'Échouée de supprimer un produit en stock');
        } else {
            $produit->delete();
            return to_route('produits.index')->with('success', 'Produit supprimé avec succès');
        }
    }
}