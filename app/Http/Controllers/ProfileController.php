<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $cliente = $request->user();
        return view('profile.edit', [
            'cliente' => $cliente,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo_electronico' => 'required|string|email|max:255|unique:clientes,correo_electronico,' . $request->user()->id,
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'tipo_cliente' => 'required|in:comprador,vendedor,arrendatario,arrendador',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        $cliente = $request->user();

        //$request->user()->fill($request->validated());

        if ($request->filled('password')) {
            $request->merge(['password' => bcrypt($request->password)]);
        }

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        $cliente->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo_electronico' => $request->correo_electronico,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'tipo_cliente' => $request->tipo_cliente,
            'imagen' => $request->imagen ? $request->file('imagen')->store('images/cliente') : $cliente->imagen,
            'password' => $request->password ?? $cliente->password
        ]);

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

        $cliente = $request->user();

        Auth::logout();

        $cliente->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
