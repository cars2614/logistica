<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCiudadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:100', "regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s.']+$/"],
            'codigo_postal' => ['required', 'regex:/^[0-9]+$/', 'digits_between:5,6'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la ciudad es obligatorio.',
            'nombre.string' => 'El nombre de la ciudad debe ser una cadena de texto.',
            'nombre.max' => 'El nombre de la ciudad no puede superar los 100 caracteres.',
            'nombre.regex' => 'El nombre de la ciudad solo debe contener letras y espacios.',
            'codigo_postal.required' => 'El código postal es obligatorio.',
            'codigo_postal.regex' => 'El código postal debe ser exclusivamente numérico.',
            'codigo_postal.digits_between' => 'El código postal debe tener entre 5 y 6 dígitos.',
        ];
    }
}
