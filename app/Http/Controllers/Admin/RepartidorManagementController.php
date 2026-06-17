<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRepartidorRequest;
use App\Http\Requests\UpdateRepartidorRequest;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RepartidorManagementController extends Controller
{
    public function create()
    {
        $repartidores = User::role(RoleEnum::REPARTIDOR->value)
            ->with(['repartidor.vehiculo'])
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
                },
            ])
            ->get();

        $vehiculos = Vehiculo::where('estado', 'Activo')->get();

        return view('admin.repartidor.create', compact('repartidores', 'vehiculos'));
    }

    public function store(StoreRepartidorRequest $request)
    {
        $fotoPath = null;

        // 1. Procesar archivo de forma aislada
        if ($request->hasFile('foto_perfil')) {
            $fotoPath = $request->file('foto_perfil')->store('repartidores', 'public');
        }

        try {
            DB::transaction(function () use ($request, $fotoPath) {
                // 2. Crear credenciales de acceso global
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                $user->assignRole(RoleEnum::REPARTIDOR->value);

                // 3. Crear datos específicos del repartidor
                $user->repartidor()->create([
                    'cedula' => $request->cedula,
                    'numero_telefonico' => $request->numero_telefonico,
                    'licencia' => $request->licencia,
                    'foto_perfil' => $fotoPath,
                ]);
            });

            return redirect()->route('admin.repartidor.create')->with('success', '¡Éxito! El repartidor ha sido registrado en el sistema.');
        } catch (\Exception $e) {
            // Revertir archivo físico si la DB falla
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }

            return back()->withInput()->with('error', 'Ocurrió un error al registrar: '.$e->getMessage());
        }
    }

    public function update(UpdateRepartidorRequest $request, $id)
    {
        $user = User::role(RoleEnum::REPARTIDOR->value)->findOrFail($id);
        $repartidor = $user->repartidor;

        $fotoPath = $repartidor->foto_perfil ?? null;
        $newFotoUploaded = false;

        if ($request->hasFile('foto_perfil')) {
            $fotoPath = $request->file('foto_perfil')->store('repartidores', 'public');
            $newFotoUploaded = true;
        }

        try {
            DB::transaction(function () use ($request, $user, $repartidor, $fotoPath) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);

                if ($request->filled('password')) {
                    $user->update([
                        'password' => Hash::make($request->password),
                    ]);
                }

                if ($repartidor) {
                    $repartidor->update([
                        'cedula' => $request->cedula,
                        'numero_telefonico' => $request->numero_telefonico,
                        'licencia' => $request->licencia,
                        'foto_perfil' => $fotoPath,
                    ]);
                } else {
                    $user->repartidor()->create([
                        'cedula' => $request->cedula,
                        'numero_telefonico' => $request->numero_telefonico,
                        'licencia' => $request->licencia,
                        'foto_perfil' => $fotoPath,
                    ]);
                }
            });

            // Borrar foto vieja si se subió una nueva exitosamente
            if ($newFotoUploaded && $repartidor && $repartidor->foto_perfil) {
                Storage::disk('public')->delete($repartidor->foto_perfil);
            }

            return redirect()->route('admin.repartidor.create')->with('success', 'Datos del repartidor actualizados con éxito.');
        } catch (\Exception $e) {
            if ($newFotoUploaded && $fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }

            return back()->withInput()->with('error', 'Error al actualizar: '.$e->getMessage());
        }
    }

    public function updatePassword(Request $request, $id)
    {
        if (! auth()->user()->hasRole(RoleEnum::ADMINISTRADOR->value)) {
            abort(403, 'Acceso denegado.');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $repartidor = User::role(RoleEnum::REPARTIDOR->value)->findOrFail($id);

        $repartidor->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'La contraseña del repartidor ha sido actualizada con éxito.');
    }

    public function assignVehicle(Request $request, $id)
    {
        $request->validate([
            'id_vehiculo' => 'nullable|exists:vehiculos,id',
        ]);

        $user = User::role(RoleEnum::REPARTIDOR->value)->findOrFail($id);

        if (! $user->repartidor) {
            return redirect()->back()->with('error', 'Atención: Debes completar los datos personales de este conductor (botón Editar Datos) antes de poder asignarle un vehículo.');
        }

        $user->repartidor->update([
            'id_vehiculo' => $request->id_vehiculo,
        ]);

        return redirect()->back()->with('success', 'Vehículo asignado con éxito al repartidor.');
    }
}
