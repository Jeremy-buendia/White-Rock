<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    protected $table = 'transacciones';

    protected $fillable = [
        'propiedad_id',
        'user_id',
        'agente_id',
        'tipo_transaccion',
        'fecha_transaccion',
        'precio_transaccion',
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'propiedad_id');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    public function agente()
    {
        return $this->belongsTo(AgenteInmobiliario::class, 'agente_id');
    }
}
