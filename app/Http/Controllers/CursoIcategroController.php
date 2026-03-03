<?php

namespace App\Http\Controllers;

use App\Models\CursoIcategro;
use App\Models\OfertaEducativa;
use Illuminate\Http\Request;

class CursoIcategroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = CursoIcategro::with('especialidadOcupacional.campoFormacion.ofertaEducativa')->get();
        $ofertas = OfertaEducativa::all();

        return view('cursos_icategro.index', compact('cursos', 'ofertas'));
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
            'especialidad_ocupacional_id' => 'required|exists:especialidad_ocupacionals,id',
            'name' => 'required|string|max:255',
            'modalidad' => 'required|string|max:255',
            'duracion_horas' => 'required|integer|min:1',
        ]);

        CursoIcategro::create($request->all());

        return redirect()->route('cursos-icategro.index')->with('success', 'Curso ICATEGRO registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CursoIcategro $cursoIcategro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CursoIcategro $cursoIcategro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CursoIcategro $cursoIcategro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CursoIcategro $cursoIcategro)
    {
        //
    }
}
