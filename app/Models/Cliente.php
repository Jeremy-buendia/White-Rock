<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;  // Importa el modelo de autenticación
use Illuminate\Notifications\Notifiable;
use App\Models\SolicitudVisita;
use App\Models\Transaccion;
use App\Models\Contrato;
use App\Models\Visita;

class Cliente extends Authenticatable  // Extiende de Authenticatable
{
    use HasFactory, Notifiable;  // Usa Notifiable para las notificaciones

    // Definir la tabla que se usará (si es diferente al plural del modelo)
    protected $table = 'clientes';  // Tabla de la base de datos (si es 'clientes', ponlo aquí)

    // Los atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'correo_electronico',
        'direccion',
        'imagen',
        'password'
    ];

    // Campos que estarán ocultos para los arreglos (como el campo de la contraseña)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Los tipos de datos de los atributos
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relaciones
    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }

    public function solicitudesVisitas()
    {
        return $this->hasMany(SolicitudVisita::class);
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }

    public function visitas()
    {
        return $this->hasMany(Visita::class);
    }

    // Si usas un campo diferente para la verificación del correo electrónico, modifícalo aquí
    // Si 'correo_electronico' es tu campo para el email, asegúrate de que esté bien.
    public function getEmailForPasswordReset()
    {
        return $this->correo_electronico;
    }
}
