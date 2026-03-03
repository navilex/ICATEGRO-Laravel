<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfertaEducativa;
use App\Models\Curso;
use App\Models\CursoIcategro;

class ConsultaOfertaController extends Controller
{
    public function index()
    {
        $ofertas = OfertaEducativa::all();
        // By default we don't load data until an oferta is selected via AJAX
        return view('consulta_oferta.index', compact('ofertas'));
    }

    public function getCursosByOferta($ofertaId)
    {
        // 1. Get Normal Cursos
        $cursosNormales = Curso::with([
            'especialidadOcupacional' => function ($q) {
                $q->select('id', 'name', 'clave', 'campo_formacion_id', 'modalidad'); // we need campo_formacion_id for nested
            },
            'especialidadOcupacional.campoFormacion' => function ($q) {
                $q->select('id', 'name');
            }
        ])
            ->whereHas('especialidadOcupacional.campoFormacion', function ($query) use ($ofertaId) {
                $query->where('oferta_educativa_id', $ofertaId);
            })
            ->get();

        // 2. Get Cursos ICATEGRO
        $cursosIcategro = CursoIcategro::with([
            'especialidadOcupacional' => function ($q) {
                $q->select('id', 'name', 'clave', 'campo_formacion_id', 'modalidad');
            },
            'especialidadOcupacional.campoFormacion' => function ($q) {
                $q->select('id', 'name');
            }
        ])
            ->whereHas('especialidadOcupacional.campoFormacion', function ($query) use ($ofertaId) {
                $query->where('oferta_educativa_id', $ofertaId);
            })
            ->get();

        // 3. Format into a unified structure for the DataTable
        $data = [];

        foreach ($cursosNormales as $curso) {
            $data[] = [
                'campo_formacion' => $curso->especialidadOcupacional->campoFormacion->name ?? '',
                'especialidad_ocupacional' => $curso->especialidadOcupacional->name ?? '',
                'clave_especialidad' => $curso->especialidadOcupacional->clave ?? '',
                'modalidad_especialidad' => $curso->especialidadOcupacional->modalidad ?? '',
                'curso_oferta' => $curso->name,
                'modalidad_curso' => $curso->modalidad,
                'duracion' => $curso->duracion_horas . ' hrs.'
            ];
        }

        foreach ($cursosIcategro as $curso) {
            $data[] = [
                'campo_formacion' => $curso->especialidadOcupacional->campoFormacion->name ?? '',
                'especialidad_ocupacional' => $curso->especialidadOcupacional->name ?? '',
                'clave_especialidad' => $curso->especialidadOcupacional->clave ?? '',
                'modalidad_especialidad' => $curso->especialidadOcupacional->modalidad ?? '',
                'curso_oferta' => $curso->name, // Reusing column for 'Curso Oferta - ICATEGRO'
                'modalidad_curso' => $curso->modalidad,
                'duracion' => $curso->duracion_horas . ' hrs.'
            ];
        }

        return response()->json(['data' => $data]);
    }
}
