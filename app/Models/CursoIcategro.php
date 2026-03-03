<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoIcategro extends Model
{
    use HasFactory;

    protected $fillable = [
        'especialidad_ocupacional_id',
        'name',
        'modalidad',
        'duracion_horas',
        'status',
    ];

    public function especialidadOcupacional()
    {
        return $this->belongsTo(EspecialidadOcupacional::class);
    }
}
