<?php

namespace App\Http\Controllers;

use App\Models\Retours;
use Illuminate\Http\Request;

class RetoursController extends Controller
{
    
    public function index()
    {
        $retours = Retours::all();
        return view('retours.index', compact('retours'));
    }

    
    public function create()
    {
        return view('retours.create', compact('retours'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'commande_client_id' => 'required',
            'produit_id' => 'required',
            'quantite' => 'required',
            'date_retour' => 'required',
            'motif' => 'required',
            'comptable_id' => 'required',
            'region_id' => 'required',
            'notes' => 'required',
        ]);

        $retours = Retours::create($req->all());
        return to_route('retours.index')->with('success', 'Retour créé avec succès');
    }

    public function show(Retours $retours)
    {
        return view('retours.show', compact('retours'));
    }

    
    public function edit(Retours $retours)
    {
        return view('retours.edit', compact('retours'));
    }


    public function update(Request $req, Retours $retours)
    {
        $req->validate([
            'commande_client_id' => 'required',
            'produit_id' => 'required',
            'quantite' => 'required',
            'date_retour' => 'required',
            'motif' => 'required',
            'comptable_id' => 'required',
            'region_id' => 'required',
            'notes' => 'required',
        ]);

        $retours->update($req->all());
        return to_route('retours.index')->with('success', 'Retour modifié avec succès');
    }

    
    public function destroy(Retours $retours)
    {
        $retours->delete();
        return to_route('retours.index')->with('success', 'Retour supprimé avec succès');
    }
}