<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
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

        return $next($request);
    }
}