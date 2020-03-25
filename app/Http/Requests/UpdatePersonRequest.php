<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Person;

class UpdatePersonRequest extends FormRequest
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
            'identification' => 'required|max:50',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string',
            'sex' => 'required',
            'address' => 'nullable|max:250',
            'birth' => 'nullable|date',
            'city' => 'nullable',
            'country' => 'nullable',
            'phone' => 'nullable',
            'photo' => 'nullable'
        ];
    }

    public function attributes()
    {
        return [
            'identification' => 'Identificación',
            'first_name' => 'Nombres',
            'last_name' => 'Apellidos',
            'email' => 'Correo electrónico',
            'sex' => 'Sexo',
            'address' => 'Dirección',
            'birth' => 'Fecha de cumpleaños',
            'city' => 'Ciudad',
            'country' => 'País',
            'phone' => 'Teléfono',
            'photo' => 'Foto'
        ];
    }
}
