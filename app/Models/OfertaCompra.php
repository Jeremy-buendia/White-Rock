<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaCompra extends Model
{
    use HasFactory;

    protected $table = 'ofertas_compras';

    protected $fillable = [
        'id_propiedad',
        'monto_oferta',
        'estado',
    ];
}