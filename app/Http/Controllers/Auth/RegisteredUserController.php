<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cliente; // Cambiado de User a Cliente
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        //dd($request->all());
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'correo_electronico' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:clientes,correo_electronico'], // Cambiado de email a correo_electronico
            'telefono' => ['nullable', 'string', 'max:15'],
            'direccion' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $hashedPassword = Hash::make($request->password);

        // $cliente = Cliente::create([
        //     'nombre' => $request->nombre,
        //     'apellido' => $request->apellido,
        //     //'apellido' => "Gonzalez",
        //     'correo_electronico' => $request->correo_electronico,
        //     'telefono' => $request->telefono,
        //     //'telefono' => "600000000",
        //     'direccion' => $request->direccion,
        //     //'direccion' => "C/ Lorca n1",
        //     'password' => $hashedPassword,
        // ]);

        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->correo_electronico = $request->correo_electronico;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->forceFill(['password' => $hashedPassword]);

        $cliente->save();

        //dd($cliente);


        event(new Registered($cliente));

        Auth::login($cliente);

        return redirect(route('dashboard', absolute: false));
    }
}
