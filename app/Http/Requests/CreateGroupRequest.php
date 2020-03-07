<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Group;

class CreateGroupRequest extends FormRequest
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
        return Group::$rules;
    }

    public function attributes()
    {
        return [
            'parent_id' => 'Id Padre',
            'identification' => 'Identificación',
            'name' => 'Nombre',
            'description' => 'Descripción'
        ];
    }
}