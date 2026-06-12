<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::where('name', 'like', '%mono%')->orWhere('email', 'like', '%mono%')->first();
if ($user) {
    $rol = \App\Models\Rol::where('nombreRol', 'Administrador')->first();
    if ($rol) {
        $user->id_rol = $rol->id;
        $user->save();
        echo "Exito: El usuario {$user->name} ahora tiene el rol de {$rol->nombreRol}.\n";
    } else {
        echo "Error: No se encontro el rol Administrador.\n";
    }
} else {
    echo "Error: No se encontro al usuario mono.\n";
}
