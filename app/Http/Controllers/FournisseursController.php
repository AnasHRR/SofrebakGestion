<?php

namespace App\Http\Controllers;

use App\Models\fournisseurs;
use Illuminate\Http\Request;

class FournisseursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        if ($search) {
            $fournisseurs = fournisseurs::where('nom', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%")
                ->orWhere('personne_contact', 'like', "%{$search}%")
                ->orWhere('telephone', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('adresse', 'like', "%{$search}%")
                ->orWhere('conditions_paiement', 'like', "%{$search}%")
                ->get();
        } else {
            $fournisseurs = fournisseurs::all();
        }
        return view("fournisseurs.index", compact("fournisseurs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("fournisseurs.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'nom' => 'required',
            'personne_contact'=>'required',
            'telephone'=>'required',
            'email'=>'required',
            'adresse'=>'required',
            'conditions_paiement'=>'required',
        ]);

        fournisseurs::create([
            'nom'=> $req->nom,
            'personne_contact'=> $req->personne_contact,
            'telephone'=> $req->telephone,
            'email'=> $req->email,
            'adresse'=> $req->adresse,
            'conditions_paiement'=> $req->conditions_paiement,
        ]);

        return to_route('fournisseurs.index')->with('success', 'Fournisseur ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(fournisseurs $fournisseur)
    {
        return to_route('fournisseurs.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(fournisseurs $fournisseur)
    {
        return view('fournisseurs.edit', compact('fournisseur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, fournisseurs $fournisseur)
    {
        $req->validate([
            'nom' => 'required',
        ]);

        $fournisseur->update([
            'nom' => $req->nom,
            'personne_contact' => $req->personne_contact,
            'telephone' => $req->telephone,
            'email'=> $req->email,
            'adresse'=> $req->adresse,
            'conditions_paiement'=> $req->conditions_paiement,
        ]);

        return to_route('fournisseurs.index')->with('success', 'Fournisseur modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(fournisseurs $fournisseur)
    {
        $fournisseur->delete();
        return to_route('fournisseurs.index')->with('success', 'Fournisseur supprimé avec succès.');
    }
}