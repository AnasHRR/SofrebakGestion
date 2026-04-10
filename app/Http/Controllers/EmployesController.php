<?php

namespace App\Http\Controllers;

use App\Models\employes;
use Illuminate\Http\Request;

class EmployesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employes = employes::all();
        return view('employes.index', compact('employes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(employes $employes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(employes $employes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, employes $employes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(employes $employes)
    {
        //
    }
}
