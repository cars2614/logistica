<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Enums\RoleEnum;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado y tiene permisos
        if (Auth::check()) {
            // Permitir solo a los administradores
            if (Auth::user()->hasRole(RoleEnum::ADMINISTRADOR->value)) {
                return $next($request);
            }
        }

        // Si es un repartidor o cualquier otro rol intentando acceder al área admin, abortar con 403
        abort(403, 'Acceso denegado. Se requieren privilegios de administrador para ver este módulo.');
    }
}
