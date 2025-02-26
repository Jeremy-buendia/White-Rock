<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'propiedad_id',
        'cliente_id',
        'agente_id',
        'tipo_contrato',
        'fecha_inicio',
        'fecha_finalizacion',
        'condiciones',
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function agente()
    {
        return $this->belongsTo(AgenteInmobiliario::class);
    }
}
