<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoRevision extends Model
{
    protected $fillable = [
        'grupo_id',
        'estatus',
        'observaciones',
        'user_id'
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
