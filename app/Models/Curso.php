<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EspecialidadOcupacional;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'especialidad_ocupacional_id',
        'name',
        'modalidad',
        'clave',
        'duracion_horas',
        'cursos_prerrequisito',
        'estrategias_aprendizaje',
        'estrategias_evaluacion',
        'certificacion_academica',
        'documentos_apoyo',
        'status',
    ];

    public function especialidadOcupacional()
    {
        return $this->belongsTo(EspecialidadOcupacional::class);
    }
}
