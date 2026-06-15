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
        $repartidores = User::role('Repartidor')
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
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('Repartidor');

        return redirect()->route('admin.repartidor.create')->with('success', '¡Éxito! El repartidor ha sido registrado en el sistema.');
    }

    public function updatePassword(\Illuminate\Http\Request $request, $id)
    {
        if (!auth()->user()->hasRole('Administrador')) {
            abort(403, 'Acceso denegado.');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $repartidor = User::role('Repartidor')->findOrFail($id);

        $repartidor->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'La contraseña del repartidor ha sido actualizada con éxito.');
    }
}
