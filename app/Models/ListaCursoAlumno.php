<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListaCursoAlumno extends Model
{
    protected $table = 'lista_cursos_alumnos';

    protected $fillable = [
        'student_id',
        'group_status',
        'plantel',
        'group_id',
        'name',
        'start_date',
        'end_date',
        'student_status',
        'grade',
        'doc_type',
        'folio',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
