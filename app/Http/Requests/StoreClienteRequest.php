<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cedula' => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/', 'unique:clientes,cedula'],
            'nombre' => ['required', 'string', 'max:100', "regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s.']+$/"],
            'telefono' => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'correo' => ['required', 'email', 'max:100', 'unique:clientes,correo'],
            'direccion' => ['required', 'string', 'max:200'],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'id_ciudad' => ['required', 'exists:ciudades,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'cedula.required' => 'La cédula es obligatoria.',
            'cedula.unique' => 'Esta cédula ya está registrada.',
            'cedula.max' => 'La cédula no puede superar 20 caracteres.',
            'cedula.regex' => 'La cédula solo debe contener números.',
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo debe contener letras, espacios, puntos y apóstrofes.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex' => 'El teléfono solo debe contener números.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'El correo no tiene un formato válido.',
            'correo.unique' => 'Este correo ya está registrado.',
            'direccion.required' => 'La dirección es obligatoria.',
            'id_ciudad.required' => 'La ciudad es obligatoria.',
            'id_ciudad.exists' => 'La ciudad seleccionada no es válida.',
        ];
    }
}
