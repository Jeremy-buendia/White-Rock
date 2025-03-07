<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotografiaPropiedad extends Model
{
    use HasFactory;

    protected $table = 'fotografias_propiedades';

    protected $fillable = [
        'propiedad_id',
        'url_fotografia',
        'descripcion',
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class);
    }
}
