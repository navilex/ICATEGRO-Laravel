<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poblacion extends Model
{
    protected $table = 'poblaciones';

    protected $fillable = ['name'];

    public function convenios()
    {
        return $this->belongsToMany(Convenio::class, 'convenio_poblacion');
    }
}
