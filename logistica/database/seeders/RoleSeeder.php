<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // findOrCreate busca si ya existe, y si no, lo crea. ¡Así no da error!
        Role::findOrCreate('administrador');
        Role::findOrCreate('repartidor');
        Role::findOrCreate('cliente');
    }
}
