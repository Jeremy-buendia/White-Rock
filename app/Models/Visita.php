<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'propiedad_id',
        'cliente_id',
        'agente_id',
        'fecha_visita',
        'hora_visita',
        'observaciones',
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agente()
    {
        return $this->belongsTo(AgenteInmobiliario::class);
    }
}
