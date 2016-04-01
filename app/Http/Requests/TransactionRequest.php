<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TransactionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'idcliente' => 'required',
            'fecha' => 'required',
            'hora' => 'required',
            'monto' => 'required',
            'interes' => 'required',
        ];
    }
    /**
     * Mensajes de validacion
     * @return string mensajes
     */
    public function messages()
    {

        return [
            'idcliente.required' => 'El campo Cliente es obligatorio.',
            'fecha.required' => 'El campo fecha es obligatorio.',
            'hora.required' => 'El campo hora es obligatorio.',
            'monto.required' => 'El campo monto es obligatorio.',
            'interes.required' => 'El campo interes es obligatorio.',

        ];
    }
}
