<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Cliente;
use App\Models\Propiedad;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // Lista todas las propiedades en estado "disponible".
    
    public function obtenerPropiedadesDisponibles(): View
    {
        $propiedades = Propiedad::where('estado', 'disponible')->get();
        return view('propiedades.disponibles', compact('propiedades'));
    }

    // Filtra propiedades según precio, tipo, ubicación, etc.
    
    public function buscarPropiedades(Request $request): View
    {
        $criterios = $request->all();
        $propiedades = Propiedad::where($criterios)->get();
        return view('propiedades.resultados', compact('propiedades'));
    }

    // Muestra la información completa de una propiedad.
    
    public function verDetallesPropiedad($idPropiedad): View
    {
        $propiedad = Propiedad::findOrFail($idPropiedad);
        return view('propiedades.detalles', compact('propiedad'));
    }

    
    // Marca una propiedad como favorita.

    public function guardarPropiedadFavorita($idCliente, $idPropiedad): RedirectResponse
    {
        $cliente = Cliente::findOrFail($idCliente);
        $cliente->favoritas()->attach($idPropiedad);
        return Redirect::back()->with('status', 'propiedad-favorita-guardada');
    }
}
