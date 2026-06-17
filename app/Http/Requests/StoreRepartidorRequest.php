<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRepartidorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Solo administradores pueden llegar aquí por middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', "regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s.']+$/"],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'cedula' => ['required', 'string', 'max:20', 'unique:repartidores,cedula'],
            'numero_telefonico' => ['required', 'string', 'max:20'],
            'licencia' => ['required', 'string', 'max:50'],
            'foto_perfil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre completo es obligatorio.',
            'name.regex' => 'El nombre solo debe contener letras, espacios, puntos y apóstrofes.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'cedula.required' => 'La cédula es obligatoria.',
            'cedula.unique' => 'Esta cédula ya está registrada.',
            'numero_telefonico.required' => 'El número telefónico es obligatorio.',
            'licencia.required' => 'La licencia es obligatoria.',
            'foto_perfil.image' => 'La foto de perfil debe ser una imagen.',
            'foto_perfil.max' => 'La foto de perfil no debe pesar más de 2MB.',
        ];
    }
}
