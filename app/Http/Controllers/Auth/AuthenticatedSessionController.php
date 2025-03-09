<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request)
    {
        // Obtener la URL anterior
        $previousUrl = url()->previous();

        // Verificar si la URL anterior contiene '/agente'
        if ($previousUrl && strpos($previousUrl, '/agente') !== false) {
            // Redirigir al login de agente si la ruta anterior era de agente
            return redirect()->route('agente.login');
        }

        // Si la URL anterior no era de agente, devolver la vista del login normal
        return view('auth.login');
    }



    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
