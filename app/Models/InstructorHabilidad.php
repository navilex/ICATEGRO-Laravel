<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorHabilidad extends Model
{
    use HasFactory;

    protected $table = 'instructor_habilidades';

    protected $fillable = [
        'instructor_id',
        'habilidad',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
