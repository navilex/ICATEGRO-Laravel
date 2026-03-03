<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'curp',
        'name',
        'lastname1',
        'lastname2',
        'blood_type',
        'civil_status',
        'state',
        'municipality',
        'locality',
        'colony',
        'street',
        'exterior_number',
        'interior_number',
        'zip_code',
        'phone1',
        'phone2',
        'email',
        'user_id',
    ];

    protected $appends = ['matricula'];

    public function getMatriculaAttribute()
    {
        // Format: 23120001S + 6 digits ID (e.g. 23120001S000001)
        return '23120001S' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    public function getFechaNacimientoAttribute()
    {
        if (strlen($this->curp) >= 10) {
            $year = substr($this->curp, 4, 2);
            $month = substr($this->curp, 6, 2);
            $day = substr($this->curp, 8, 2);
            // Assuming 19xx for year > 25, 20xx for year <= 25 depending on current year
            $prefix = ($year > date('y') + 5) ? '19' : '20';
            return $day . '/' . $month . '/' . $prefix . $year;
        }
        return 'N/A';
    }

    public function getEdadAttribute()
    {
        if (strlen($this->curp) >= 10) {
            $year = substr($this->curp, 4, 2);
            $month = substr($this->curp, 6, 2);
            $day = substr($this->curp, 8, 2);
            $prefix = ($year > date('y') + 5) ? '19' : '20';
            $birthDate = $prefix . $year . '-' . $month . '-' . $day;
            return \Carbon\Carbon::parse($birthDate)->age;
        }
        return 'N/A';
    }

    public function getSexoAttribute()
    {
        if (strlen($this->curp) >= 11) {
            $sexLetter = substr($this->curp, 10, 1);
            return $sexLetter === 'H' ? 'MASCULINO' : ($sexLetter === 'M' ? 'FEMENINO' : 'N/A');
        }
        return 'N/A';
    }

    public function cursos()
    {
        return $this->hasMany(ListaCursoAlumno::class, 'student_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
