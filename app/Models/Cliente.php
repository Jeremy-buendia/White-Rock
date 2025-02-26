<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'telefono', 'correo_electronico', 'direccion', 'tipo_cliente'];

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }

    public function solicitudesVisitas()
    {
        return $this->hasMany(SolicitudVista::class);
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }

    public function visitas()
    {
        return $this->hasMany(Visita::class);
    }
}
