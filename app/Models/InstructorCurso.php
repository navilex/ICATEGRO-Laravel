<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor;

class InstructorCurso extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'curso',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
