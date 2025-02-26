<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;
    protected $fillable = [
        'direccion',
        'tipo_propiedad',
        'precio',
        'tamaño',
        'descripcion',
        'estado',
        'fecha_publicacion',
    ];

    public function agentes()
    {
        return $this->belongsToMany(AgenteInmobiliario::class, 'agente_propiedad');
    }

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }

    public function visitas()
    {
        return $this->hasMany(Visita::class);
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }

    public function solicitudesVisitas()
    {
        return $this->hasMany(SolicitudVisita::class);
    }

    public function fotografias()
    {
        return $this->hasMany(Fotografia::class);
    }
}
