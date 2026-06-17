<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTipoEntregaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tipoEntrega = $this->route('tipo_entrega');
        $id = is_object($tipoEntrega) ? $tipoEntrega->id : $tipoEntrega;

        return [
            'nombre' => ['required', 'string', 'max:100', "regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s.']+$/", 'unique:tipo_entregas,nombre,'.$id],
            'descripcion' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'in:0,1'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo debe contener letras, espacios, puntos y apóstrofes.',
            'nombre.unique' => 'Ya existe un tipo de entrega con ese nombre.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.max' => 'La descripción no puede superar los 255 caracteres.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ];
    }
}
