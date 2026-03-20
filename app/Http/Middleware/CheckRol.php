<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRol
{
    public function handle(Request $request, Closure $next, string $rol): Response
    {
        // 1. Verificar si el usuario está autenticado 
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Verificar si el rol coincide 
        if (Auth::user()->rol !== $rol) {
            abort(403, 'No tienes permiso para acceder a esta sección.'); 
        }

        return $next($request);
    }
}