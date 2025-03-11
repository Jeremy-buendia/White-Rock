<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentePropiedad extends Model
{
    use HasFactory;

    protected $table = 'agente_propiedad';

    protected $fillable = [
        'agente_inmobiliario_id',
        'propiedad_id',
    ];

    public function agente()
    {
        return $this->belongsTo(AgenteInmobiliario::class, 'agente_id');
    }

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'propiedad_id');
    }
}
