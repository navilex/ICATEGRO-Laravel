<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\OfertaEducativa;
use App\Models\EspecialidadOcupacional;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Curso::with('especialidadOcupacional.campoFormacion.ofertaEducativa')->get();
        $ofertas = OfertaEducativa::all();

        return view('cursos.index', compact('cursos', 'ofertas'));
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
            'clave' => 'required|string|max:255',
            'duracion_horas' => 'required|integer|min:1',
            'cursos_prerrequisito' => 'nullable|string|max:200',
            'estrategias_aprendizaje' => 'nullable|string|max:200',
            'estrategias_evaluacion' => 'nullable|string|max:200',
            'certificacion_academica' => 'nullable|string|max:200',
            'documentos_apoyo' => 'nullable|string|max:200',
        ]);

        Curso::create($request->all());

        return redirect()->route('cursos.index')->with('success', 'Curso registrado correctamente.');
    }

    public function getEspecialidadesByCampo($campoId)
    {
        $especialidades = EspecialidadOcupacional::where('campo_formacion_id', $campoId)->where('status', true)->get();
        return response()->json($especialidades);
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        //
    }
}
