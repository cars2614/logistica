<?php

namespace App\Http\Requests;

use App\Models\Vehiculo;
use Illuminate\Foundation\Http\FormRequest;

class StorePlanillaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ruta_id' => 'required|exists:rutas,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'piezas' => 'required|integer|min:1',
            'kilos' => 'required|numeric|min:0.1',
        ];
    }

    public function withValidator($validator)
    {
        // Validación de negocio compleja: Capacidad del vehículo vs Kilos del plan de carga
        $validator->after(function ($validator) {
            $vehiculo = Vehiculo::find($this->vehiculo_id);
            // NOTA: Mantenemos el nombre 'capacidad' según las reglas de base de datos de producción
            // que indica la carga útil máxima en kilogramos.
            if ($vehiculo && $this->kilos > $vehiculo->capacidad) {
                $validator->errors()->add('kilos', "El peso total ({$this->kilos} kg) excede la capacidad del vehículo ({$vehiculo->capacidad} kg).");
            }
        });
    }

    public function messages(): array
    {
        return [
            'ruta_id.required' => 'La ruta de distribución es obligatoria.',
            'ruta_id.exists' => 'La ruta seleccionada no existe en la base de datos.',
            'vehiculo_id.required' => 'Debe asignar un vehículo para la planilla.',
            'vehiculo_id.exists' => 'El vehículo seleccionado no existe.',
            'piezas.required' => 'La cantidad de piezas es obligatoria.',
            'piezas.integer' => 'La cantidad de piezas debe ser un número entero.',
            'piezas.min' => 'La cantidad de piezas debe ser al menos 1.',
            'kilos.required' => 'El peso total es obligatorio.',
            'kilos.numeric' => 'El pesaje debe ser numérico.',
            'kilos.min' => 'El pesaje mínimo permitido para despacho es de 0.1 kg.',
        ];
    }
}
