<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehiculoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'placa' => ['required', 'string', 'max:10', 'regex:/^[A-Za-z0-9\-]+$/', 'unique:vehiculos,placa'],
            'marca' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ\s\-]+$/'],
            'modelo' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ\s\-]+$/'],
            'capacidad' => ['required', 'numeric', 'min:1'],
            'estado' => ['required', 'in:activo,inactivo,mantenimiento'],
            'id_tipo_vehiculo' => ['required', 'exists:tipo_vehiculo,id'],
            'fecha_registro' => ['required', 'date', 'before_or_equal:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'placa.required' => 'La placa vehicular es obligatoria.',
            'placa.unique' => 'Esta placa ya se encuentra registrada en el sistema.',
            'placa.max' => 'La placa no puede superar los 10 caracteres.',
            'placa.regex' => 'La placa solo debe contener letras, números y guiones.',
            'marca.required' => 'La marca es obligatoria.',
            'marca.regex' => 'La marca contiene caracteres no permitidos (solo letras, números y guiones).',
            'modelo.required' => 'El modelo es obligatorio.',
            'modelo.regex' => 'El modelo contiene caracteres no permitidos (solo letras, números y guiones).',
            'capacidad.required' => 'La capacidad en kilos es obligatoria.',
            'capacidad.min' => 'La capacidad debe ser mayor o igual a 1 kg.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado seleccionado no es válido.',
            'id_tipo_vehiculo.required' => 'Debe seleccionar un tipo de vehículo.',
            'id_tipo_vehiculo.exists' => 'El tipo de vehículo seleccionado no existe.',
            'fecha_registro.required' => 'La fecha de registro es obligatoria.',
            'fecha_registro.date' => 'La fecha de registro debe ser una fecha válida.',
            'fecha_registro.before_or_equal' => 'La fecha de registro no puede ser una fecha futura.',
        ];
    }
}
