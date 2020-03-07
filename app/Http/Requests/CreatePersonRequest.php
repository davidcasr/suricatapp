<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Person;

class CreatePersonRequest extends FormRequest
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
        return Person::$rules;
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
