<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'type',
        'name',
        'state',
        'municipality',
        'colony',
        'street',
        'exterior_number',
        'interior_number',
        'zip_code',
        'phone1',
        'phone2',
        'email1',
        'email2',
        'web',
        'instagram',
        'facebook',
        'twitter'
    ];

    public function convenios()
    {
        return $this->belongsToMany(Convenio::class);
    }
}
