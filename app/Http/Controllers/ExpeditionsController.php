<?php

namespace App\Http\Controllers;

use App\Models\Expeditions;
use Illuminate\Http\Request;

class ExpeditionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expeditions = Expeditions::all();
        return view("expeditions.index", compact("expeditions"));
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
    public function show(Expeditions $expeditions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expeditions $expeditions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expeditions $expeditions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expeditions $expeditions)
    {
        //
    }
}
