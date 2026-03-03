<?php

namespace App\Http\Controllers;

use App\Models\EspecialidadOcupacional;
use App\Models\OfertaEducativa;
use App\Models\CampoFormacion;
use Illuminate\Http\Request;

class EspecialidadOcupacionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $especialidades = EspecialidadOcupacional::with('campoFormacion.ofertaEducativa')->get();
        $ofertas = OfertaEducativa::all();

        return view('especialidades_ocupacionales.index', compact('especialidades', 'ofertas'));
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
            'campo_formacion_id' => 'required|exists:campo_formacions,id',
            'name' => 'required|string|max:255',
            'modalidad' => 'required|string|max:255',
            'clave' => 'required|string|max:255',
            'objetivo' => 'nullable|string|max:200',
            'enfoque_educativo' => 'nullable|string|max:200',
            'cursos' => 'nullable|string|max:200',
            'sitios_insercion' => 'nullable|string|max:200',
            'certificacion_academica' => 'nullable|string|max:200',
            'certificacion_laboral' => 'nullable|string|max:200',
        ]);

        EspecialidadOcupacional::create($request->all());

        return redirect()->route('especialidades-ocupacionales.index')->with('success', 'Especialidad Ocupacional registrada correctamente.');
    }

    public function getCamposByOferta($ofertaId)
    {
        $campos = CampoFormacion::where('oferta_educativa_id', $ofertaId)->where('status', true)->get();
        return response()->json($campos);
    }

    /**
     * Display the specified resource.
     */
    public function show(EspecialidadOcupacional $especialidadOcupacional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EspecialidadOcupacional $especialidadOcupacional)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EspecialidadOcupacional $especialidadOcupacional)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EspecialidadOcupacional $especialidadOcupacional)
    {
        //
    }
}
