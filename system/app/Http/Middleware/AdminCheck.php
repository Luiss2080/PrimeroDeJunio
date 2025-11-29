<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado
        if (!session('user_id')) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'No autenticado'], 401);
            }
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        // Verificar si el usuario tiene rol de administrador
        if (session('user_role') !== 'administrador') {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Acceso denegado'], 403);
            }
            return redirect()->route('dashboard')->with('error', 'No tienes permisos para acceder a esta sección. Solo administradores.');
        }

        return $next($request);
    }
}