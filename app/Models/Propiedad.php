<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;

    protected $table = 'propiedades';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'tipo_propiedad',
        'direccion',
        'tamano',
        'estado',
        'oficina_id'
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
        return $this->hasMany(FotografiaPropiedad::class, 'propiedad_id');
    }
}
