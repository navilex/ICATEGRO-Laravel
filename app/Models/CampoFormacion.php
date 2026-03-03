<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Added this line

class CampoFormacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'oferta_educativa_id',
        'name',
        'status',
    ];

    public function ofertaEducativa()
    {
        return $this->belongsTo(OfertaEducativa::class);
    }
}
