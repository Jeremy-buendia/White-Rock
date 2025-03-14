<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Cliente;
use App\Models\Propiedad;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit(Request $request): View
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $user = $request->user();

            // Validar los datos
            $validatedData = $request->validated();

            // Verificar la contraseña actual
            if ($request->filled('password') && !Hash::check($request->input('current_password'), $user->password)) {
                return Redirect::route('profile.edit')->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
            }

            // Actualizar los datos del usuario
            $user->name = $validatedData['name'];
            $user->apellido = $validatedData['apellido'];
            $user->email = $validatedData['email'];
            $user->telefono = $validatedData['telefono'];
            $user->direccion = $validatedData['direccion'];

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            if (!empty($validatedData['password'])) {
                $user->password = bcrypt($validatedData['password']);
            }

            // Manejar la subida de la imagen
            if ($request->hasFile('imagen')) {
                $path = $request->file('imagen')->store('profile_images', 'public');
                $user->imagen = $path;
            }

            $user->save();

            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        } catch (\Exception $e) {
            // Registrar el error
            Log::error('Error al actualizar el perfil del usuario: ' . $e->getMessage());

            // Redirigir al usuario con un mensaje de error
            return Redirect::route('profile.edit')->with('error', 'Ocurrió un error al actualizar tu perfil. Por favor, inténtalo de nuevo.');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

            $user = $request->user();

            Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');
        } catch (\Exception $e) {
            // Registrar el error
            Log::error('Error al eliminar la cuenta del usuario: ' . $e->getMessage());

            // Redirigir al usuario con un mensaje de error
            return Redirect::back()->with('error', 'Ocurrió un error al eliminar tu cuenta. Por favor, inténtalo de nuevo.');
        }
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
