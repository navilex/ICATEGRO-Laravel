<?php

namespace App\Http\Controllers;

use App\Models\CampoFormacion;
use App\Models\OfertaEducativa;
use Illuminate\Http\Request;

class CampoFormacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campos = CampoFormacion::with('ofertaEducativa')->get();
        $ofertas = OfertaEducativa::all(); // Assuming you want all to choose from

        return view('campos_formacion.index', compact('campos', 'ofertas'));
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
            'oferta_educativa_id' => 'required|exists:oferta_educativas,id',
            'name' => 'required|string|max:255',
        ]);

        CampoFormacion::create($request->all());

        return redirect()->route('campos-formacion.index')->with('success', 'Campo de Formación Profesional registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CampoFormacion $campoFormacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CampoFormacion $campoFormacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CampoFormacion $campoFormacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CampoFormacion $campoFormacion)
    {
        //
    }
}
