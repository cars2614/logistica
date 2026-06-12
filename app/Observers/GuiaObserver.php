<?php

namespace App\Observers;

use App\Models\Guia;
use App\Models\EstadoGuia;
use App\Models\User;

class GuiaObserver
{

    public function created(Guia $guia): void
    {
        // 1. Intentamos obtener el ID del usuario con sesión iniciada en la web
        $usuarioId = auth()->id();

        // 2. Si es NULL (significa que estamos en consola/seeder), buscamos el primer usuario disponible
        if (is_null($usuarioId)) {
            $primerUsuario = User::first();
            $usuarioId = $primerUsuario ? $primerUsuario->id : null;
        }

        // 3. Creamos el estado inicial de la guía con el ID correcto
        EstadoGuia::create([
            'fecha_estado' => now()->toDateString(),
            'estado'       => 'Generada',
            'descripcion'  => 'Guía creada en el sistema correctamente.',
            'id_guia'      => $guia->getKey(),
            'id_usuario'   => $usuarioId, // Guardará el del logueado en la web, o el de Carlos/Juana en el seeder
        ]);
    }

  
    public function updated(Guia $guia): void
    {
        //
    }

    /**
     * Handle the Guia "deleted" event.
     */
    public function deleted(Guia $guia): void
    {
        //
    }

    /**
     * Handle the Guia "restored" event.
     */
    public function restored(Guia $guia): void
    {
        //
    }

    /**
     * Handle the Guia "force deleted" event.
     */
    public function forceDeleted(Guia $guia): void
    {
        //
    }
}
