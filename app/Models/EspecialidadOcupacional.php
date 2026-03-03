<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EspecialidadOcupacional extends Model
{
    use HasFactory;

    protected $fillable = [
        'campo_formacion_id',
        'name',
        'modalidad',
        'clave',
        'objetivo',
        'enfoque_educativo',
        'cursos',
        'sitios_insercion',
        'certificacion_academica',
        'certificacion_laboral',
        'status',
    ];

    public function campoFormacion()
    {
        return $this->belongsTo(CampoFormacion::class);
    }
}
