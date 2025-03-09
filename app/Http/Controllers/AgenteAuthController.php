<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Models\AgenteInmobiliario;
use Illuminate\Http\RedirectResponse;

class AgenteAuthController extends Controller
{
    public function loginForm()
    {
        return view('agente.login');
    }

    public function registroForm()
    {
        return view('agente.registro');
    }

    public function registro(Request $request): RedirectResponse
    {
        $request->validate([
            'oficina_id' => ['required', 'integer', 'exists:oficinas,id'],
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'correo_electronico' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('agentes_inmobiliarios', 'correo_electronico'),
                Rule::unique('users', 'email'),
            ],
            'telefono' => ['required', 'string', 'max:20'],
            'direccion' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $agente = AgenteInmobiliario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'correo_electronico' => $request->correo_electronico,
            'direccion' => $request->direccion,
            'fecha_contratacion' => now(),
            'password' => Hash::make($request->password),
            'oficina_id' => $request->id_oficina,
        ]);

        Auth::login($agente);

        return redirect()->route('agente.dashboard');
    }


    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'correo_electronico' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = [
            'correo_electronico' => strtolower($request->correo_electronico),
            'password' => $request->password,
        ];

        if (Auth::guard('agente')->attempt($credentials)) {
            return redirect()->route('agente.dashboard');
        }

        return back()->withErrors(['correo_electronico' => 'Credenciales incorrectas']);
    }

    public function logout(): RedirectResponse
    {
        Auth::guard('agente')->logout();
        return redirect()->route('agente.login');
    }
}
