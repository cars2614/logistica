<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRutaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'zona' => ['required', 'string', 'max:255', "regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s.']+$/"],
            'guia' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\-_]+$/'],
            'direccion' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ\s#\-\.\/,]+$/'],
            'sector' => ['required', 'string', 'max:255', "regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s.']+$/"],
            'ciudad' => ['required', 'string', 'max:255', "regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s.']+$/"],
            'latitud' => ['nullable', 'numeric'],
            'longitud' => ['nullable', 'numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'zona.required' => 'La zona de cobertura es obligatoria.',
            'zona.max' => 'La zona no puede superar los 255 caracteres.',
            'zona.regex' => 'La zona solo debe contener letras, espacios, puntos y apóstrofes.',
            'guia.required' => 'El identificador de guía es obligatorio.',
            'guia.max' => 'La guía no puede superar los 255 caracteres.',
            'guia.regex' => 'La guía solo debe contener letras, números, guiones y guiones bajos.',
            'direccion.required' => 'La dirección de la ruta es obligatoria.',
            'direccion.max' => 'La dirección no puede superar los 255 caracteres.',
            'direccion.regex' => 'La dirección contiene caracteres inválidos.',
            'sector.required' => 'El sector es obligatorio.',
            'sector.max' => 'El sector no puede superar los 255 caracteres.',
            'sector.regex' => 'El sector solo debe contener letras, espacios, puntos y apóstrofes.',
            'ciudad.required' => 'La ciudad de destino es obligatoria.',
            'ciudad.max' => 'La ciudad no puede superar los 255 caracteres.',
            'ciudad.regex' => 'La ciudad solo debe contener letras, espacios, puntos y apóstrofes.',
        ];
    }
}
