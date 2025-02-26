<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudVisita extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_visitas';

    protected $fillable = [
        'propiedad_id',
        'cliente_id',
        'fecha_solicitud',
        'estado',
        'fecha_propuesta',
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
