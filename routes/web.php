<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AgenteAuthController;
use App\Http\Controllers\PropiedadController;
use Illuminate\Support\Facades\Route;

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
        Route::get('/dashboard', function () {
            return view('agente.dashboard');
        })->name('agente.dashboard');
    });
});

Route::get('agente/{idAgente}/propiedades', [PropiedadController::class,]);
Route::post('agente/{idAgente}/propiedades', [PropiedadController::class,]);
Route::get('agente/{idAgente}/propiedades/{idPropiedad}', [PropiedadController::class,]);
Route::put('agente/{idAgente}/propiedades/{idPropiedad}', [PropiedadController::class,]);
Route::delete('agente/{idAgente}/propiedades/{idPropiedad}', [PropiedadController::class,]);

require __DIR__ . '/auth.php';
