<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMINISTRADOR = 'Administrador';
    case REPARTIDOR    = 'Repartidor';
    case CLIENTE       = 'Cliente';
}
