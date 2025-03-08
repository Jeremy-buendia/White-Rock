<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AgenteAuthController;
use App\Http\Controllers\PropiedadController;
use App\Http\Controllers\IntegracionController;
use App\Http\Controllers\TransaccionesController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\OficinaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgenteInmobiliarioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('agente')->group(function () {
    Route::get('/registro', [AgenteAuthController::class, 'registroForm'])->name('agente.registro');
    Route::post('/registro', [AgenteAuthController::class, 'registro']);

    Route::get('/login', [AgenteAuthController::class, 'loginForm'])->name('agente.login');
    Route::post('/login', [AgenteAuthController::class, 'login']);
    Route::post('/logout', [AgenteAuthController::class, 'logout'])->name('agente.logout');

    Route::middleware(['auth:agente'])->group(function () {
        Route::get('/dashboard', [AgenteInmobiliarioController::class, 'dashboard'])->name('agente.dashboard');

        Route::get('/crear_inmueble', [PropiedadController::class, 'create'])->name('agente.crearInmueble');
        Route::post('/crear_inmueble', [PropiedadController::class, 'store']);
        Route::get('/inmueble/{id}', [PropiedadController::class, 'index'])->name('agente.ver_inmueble');

        Route::get('/inmueble/{id}/editar', [PropiedadController::class, 'edit'])->name('inmueble.editar');
        Route::put('/inmueble/{id}', [PropiedadController::class, 'update'])->name('inmueble.actualizar');

        Route::delete('/inmueble/{id}', [PropiedadController::class, 'destroy'])->name('inmueble.destroy');

        Route::get('/crear_solicitud', [VisitaController::class, 'formularioSolicitarVisita'])->name('agente.solicitar_visita');
        Route::post('/crear_solicitud', [VisitaController::class, 'solicitarVisitaAgente']);
        Route::get('/editar_solicitud/{id}', [VisitaController::class, 'edit'])->name('visita.editar');
        Route::put('/editar_solicitud/{id}', [VisitaController::class, 'update']);
        Route::delete('/editar_solicitud/{id}', [VisitaController::class, 'destroy'])->name('visita.destroy');

        Route::get('/solicitudes/{idPropiedad}', function ($idPropiedad) {
            return view('agente.solicitudes_visitas', ['idPropiedad' => $idPropiedad]);
        })->name('agente.solicitudes_visitas');
    });
});

Route::get('agente/{idAgente}/propiedades/{idPropiedad}', [PropiedadController::class,]);
Route::put('agente/{idAgente}/propiedades/{idPropiedad}', [PropiedadController::class,]);
Route::delete('agente/{idAgente}/propiedades/{idPropiedad}', [PropiedadController::class,]);

Route::get('/solicitudes/{idPropiedad}', [IntegracionController::class, 'verSolicitudesVisitasPorPropiedad']);
Route::post('/notificar-cliente/{idSolicitud}/{estado}', [IntegracionController::class, 'notificarClienteCambioEstadoSolicitud']);
Route::post('/notificar-agente/{idAgente}/{idSolicitud}', [IntegracionController::class, 'notificarAgenteNuevaSolicitudVisita']);

Route::post('/enviar-oferta-compra/{idPropiedad}/{montoOferta}', [TransaccionesController::class, 'enviarOfertaCompra']);

Route::get('/agente/solicitudes/{idPropiedad}', [IntegracionController::class, 'verSolicitudesVisitasPorPropiedad'])->name('agente.solicitudes_visitas');
Route::get('/agente/solicitudes', [IntegracionController::class, 'verTodasSolicitudesVisitas'])->name('agente.todas_solicitudes_visitas');

Route::get('/inmuebles', [PropiedadController::class, 'index_clientes'])->name('inmuebles.index');

Route::get('/perfil', [ProfileController::class, 'show'])->name('perfil')->middleware('auth');
Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/propiedades/{id}', [PropiedadController::class, 'show'])->name('propiedades.show');

Route::get('/propiedades/{propiedad}', [PropiedadController::class, 'show'])->name('propiedades.show');

// Add routes for other controllers
Route::resource('visitas', VisitaController::class);
Route::resource('contratos', ContratoController::class);
Route::resource('oficinas', OficinaController::class);
Route::resource('users', UserController::class);
Route::resource('agente-inmobiliario', AgenteInmobiliarioController::class);

require __DIR__ . '/auth.php';
