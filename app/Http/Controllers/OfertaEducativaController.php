<?php

namespace App\Http\Controllers;

use App\Models\OfertaEducativa;
use Illuminate\Http\Request;

class OfertaEducativaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ofertas = OfertaEducativa::all();
        return view('ofertas_educativas.index', compact('ofertas'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        OfertaEducativa::create($request->all());

        return redirect()->route('ofertas-educativas.index')->with('success', 'Oferta Educativa registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OfertaEducativa $ofertaEducativa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OfertaEducativa $ofertaEducativa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OfertaEducativa $ofertaEducativa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OfertaEducativa $ofertaEducativa)
    {
        //
    }
}
