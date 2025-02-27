<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropiedadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/');

    Route::get('agente/{idAgente}/propiedades', [PropiedadController::class,]);
    Route::post('agente/{idAgente}/propiedades', [PropiedadController::class,]);
    Route::get('agente/{idAgente}/propiedades/{idPropiedad}', [PropiedadController::class,]);
    Route::put('agente/{idAgente}/propiedades/{idPropiedad}', [PropiedadController::class,]);
    Route::delete('agente/{idAgente}/propiedades/{idPropiedad}', [PropiedadController::class,]);
});

require __DIR__ . '/auth.php';
