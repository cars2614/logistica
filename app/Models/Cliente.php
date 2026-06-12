<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $fillable =[
        'nombre',
        'cedula',
        'telefono',
        'correo',
        'direccion',
        'descripcion',
        'id_ciudad',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class cliente extends Model
{
    use SoftDeletes;

    protected $fillable =[
        'nombre',
        'cedula',
        'telefono',
        'correo',
        'direccion',
        'descripcion',
        'id_ciudad',
    ];
}
