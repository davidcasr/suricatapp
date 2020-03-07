<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Community;

class UpdateCommunityRequest extends FormRequest
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
        $rules = Community::$rules;
        
        return $rules;
    }

    public function attributes()
    {
        return [
            'identification' => 'Identificación',
            'name' => 'Nombre',
            'description' => 'Descripción',
            'address' => 'Dirección',
            'latitude' => 'Latitud',
            'longitude' => 'Longitud'
        ];
    }
}
