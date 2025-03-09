<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;

class AuthenticateAgente extends Authenticate
{
    protected function redirectTo(Request $request): ?string
    {
        // Verifica si la ruta pertenece a 'agente.*' y si el agente no está autenticado
        if (! $request->expectsJson()) {
            if (
                $request->routeIs('agente.*') && !auth('agente')->check() && !$request->routeIs('agente.login') &&
                !$request->routeIs('agente.logout')
            ) {
                return route('agente.login'); // Redirige si no está autenticado
            }
        }

        return null;
    }
}
