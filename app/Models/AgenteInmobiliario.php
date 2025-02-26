<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Oficina;
use App\Models\Propiedad;

class AgenteInmobiliario extends Model
{
    use HasFactory;

    protected $table = 'agentes_inmobiliarios';

    protected $fillable = ['nombre', 'apellido', 'telefono', 'correo_electronico', 'direccion', 'fecha_contratacion', 'oficina_id'];

    public function oficina()
    {
        return $this->belongsTo(Oficina::class);
    }

    public function propiedades()
    {
        return $this->belongsToMany(Propiedad::class, 'agente_propiedad');
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
}
