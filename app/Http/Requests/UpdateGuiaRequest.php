<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuiaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_tipo_entrega' => 'required|exists:tipo_entregas,id',
            'id_cliente_origen' => 'required|exists:clientes,id',
            'id_cliente_destino' => 'required|exists:clientes,id',
            'unidades' => 'required|integer|min:1',
            'peso' => 'required|numeric|min:0.1',
            'largo' => 'required|numeric|min:0.01',
            'ancho' => 'required|numeric|min:0.01',
            'alto' => 'required|numeric|min:0.01',
            'precio_envio' => 'required|numeric|min:0',
            'valor_declarado' => 'required|numeric|min:0',
            'observacion' => 'nullable|string|max:255',
            'id_repartidor' => 'nullable|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id_tipo_entrega.required' => 'El tipo de entrega es mandatorio para la logística del envío.',
            'id_tipo_entrega.exists' => 'El tipo de entrega seleccionado no es válido en el sistema.',
            'id_cliente_origen.required' => 'Debe asignar un cliente remitente.',
            'id_cliente_origen.exists' => 'El cliente remitente no existe.',
            'id_cliente_destino.required' => 'Debe asignar un cliente destinatario.',
            'id_cliente_destino.exists' => 'El cliente destinatario no existe.',
            'unidades.required' => 'La cantidad de unidades es obligatoria.',
            'unidades.min' => 'Debe enviar al menos 1 unidad.',
            'peso.required' => 'El peso es obligatorio.',
            'peso.min' => 'El peso debe ser mayor a 0.',
            'largo.required' => 'El largo es obligatorio.',
            'ancho.required' => 'El ancho es obligatorio.',
            'alto.required' => 'El alto es obligatorio.',
            'precio_envio.required' => 'El precio de envío es obligatorio.',
            'valor_declarado.required' => 'El valor declarado es obligatorio.',
            'valor_declarado.numeric' => 'El valor declarado debe ser numérico.',
        ];
    }
}
