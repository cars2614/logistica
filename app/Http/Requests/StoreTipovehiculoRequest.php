<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipovehiculoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:100', "regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ\s\-]+$/", 'unique:tipo_vehiculo,nombre'],
            'descripcion' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del tipo de vehículo es obligatorio.',
            'nombre.regex' => 'El nombre del tipo de vehículo contiene caracteres no permitidos.',
            'nombre.unique' => 'Este tipo de vehículo ya existe.',
            'nombre.max' => 'El nombre no puede superar 100 caracteres.',
            'descripcion.max' => 'La descripción no puede superar 255 caracteres.',
        ];
    }
}
