<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AgenteInmobiliario;

class Oficina extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'direccion', 'telefono', 'fax'];

    public function agentes()
    {
        return $this->hasMany(AgenteInmobiliario::class);
    }
}
