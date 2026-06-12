<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rol;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;

class RepartidorManagementController extends Controller
{
    public function create()
    {
        $repartidores = User::whereHas('rol', function ($q) {
            $q->where('nombreRol', 'Repartidor');
        })
        ->withCount([
            'guiasAsignadas as total_guias',
            'guiasAsignadas as guias_entregadas_count' => function ($q) {
                $q->whereHas('estados', function ($q2) {
                    $q2->where('estado', 'Entregado')
                       ->whereRaw('estado_guias.id IN (SELECT MAX(id) FROM estado_guias GROUP BY id_guia)');
                });
            },
            'guiasAsignadas as guias_pendientes_count' => function ($q) {
                $q->whereDoesntHave('estados', function ($q2) {
                    $q2->whereIn('estado', ['Entregado', 'Novedad/Devolución'])
                       ->whereRaw('estado_guias.id IN (SELECT MAX(id) FROM estado_guias GROUP BY id_guia)');
                });
            }
        ])
        ->get();

        return view('admin.repartidor.create', compact('repartidores'));
    }

    public function store(StoreUserRequest $request)
    {
        $rolRepartidor = Rol::where('nombreRol', 'Repartidor')->first();

        if (!$rolRepartidor) {
            return redirect()->back()->with('error', 'El rol de Repartidor no existe en la base de datos.');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_rol' => $rolRepartidor->id,
        ]);

        return redirect()->route('admin.repartidor.create')->with('success', '¡Éxito! El repartidor ha sido registrado en el sistema.');
    }

    public function updatePassword(\Illuminate\Http\Request $request, $id)
    {
        $roleName = auth()->user()->rol ? auth()->user()->rol->nombreRol : 'Ninguno';
        if (!in_array($roleName, ['Administrador', 'Super Administrador'])) {
            abort(403, 'Acceso denegado. Tu rol actual detectado es: ' . $roleName);
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $repartidor = User::whereHas('rol', function ($q) {
            $q->where('nombreRol', 'Repartidor');
        })->findOrFail($id);

        $repartidor->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'La contraseña del repartidor ha sido actualizada con éxito.');
    }
}
