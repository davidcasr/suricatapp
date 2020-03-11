<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UpdateUserRequest extends FormRequest
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
            'first_name' => 'nullable|string|max:255', 
            'last_name' => 'nullable|string|max:255', 
            'username' => 'required|string|max:255', 
            'email' => 'required|email|unique:users,email'.$this->route('user'),
            'phone' => 'nullable|string|max:100'
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'Nombres',
            'last_name' => 'Apellido',
            'username' => 'Usuario',
            'email' => 'Correo electrónico',
            'password' => 'Contraseña',
            'phone' => 'Teléfono',
        ];
    }
}