<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor;

class InstructorIdioma extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'idioma',
        'estudio_extranjero',
        'estado',
        'municipio',
        'institucion',
        'porcentaje_conocimiento',
        'estatus_estudios',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
