<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Oficina;
use App\Models\Propiedad;

class AgenteInmobiliario extends Authenticatable
{
    use HasFactory;

    // protected $primaryKey = 'id';
    // public $incrementing = true;
    // protected $keyType = 'int';

    protected $table = 'agentes_inmobiliarios';

    protected $fillable = ['nombre', 'apellido', 'telefono', 'correo_electronico', 'direccion', 'fecha_contratacion', 'password', 'oficina_id'];

    protected $hidden = ['password', 'remember_token'];

    // protected $casts = ['password' => 'hashed'];

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

    public function getAuthIdentifierName()
    {
        return 'id';
    }
}
