<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ControlRoles
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, int $roleId): Response
    {
        // 1. Si ni siquiera está logueado, lo mandamos al login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 2. Si está logueado pero su rol no coincide con el permitido para esa ruta
        if (auth()->user()->role_id !== $roleId) {
            return redirect('/')->with('error', 'No tenés permisos para ingresar a esa sección.');
        }

        return $next($request);
    }
}