<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado y tiene rol
        if (Auth::check() && Auth::user()->rol) {
            $nombreRol = Auth::user()->rol->nombreRol;
            
            // Permitir solo a los administradores
            if (in_array($nombreRol, ['Administrador', 'Super Administrador'])) {
                return $next($request);
            }
        }

        // Si es un repartidor o cualquier otro rol intentando acceder al área admin, abortar con 403
        abort(403, 'Acceso denegado. Se requieren privilegios de administrador para ver este módulo.');
    }
}
