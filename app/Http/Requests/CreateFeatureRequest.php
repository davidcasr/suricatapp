<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Feature;

class CreateFeatureRequest extends FormRequest
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
        return Feature::$rules;
    }

    public function attributes()
    {
        return [
            'name' => 'Nombre',
            'description' => 'Descripción',
        ];
    }
}
