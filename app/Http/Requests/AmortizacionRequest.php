<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AmortizacionRequest extends Request
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
            'entrada' => 'required'
        ];
    }

    /**
     * Mensajes de validacion
     * @return string mensajes
     */
    public function messages()
    {

        return [
            'entrada.required' => 'El campo monto es obligatorio.',

        ];
    }
}
