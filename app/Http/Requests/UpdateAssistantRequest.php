<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Assistant;

class UpdateAssistantRequest extends FormRequest
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
        $rules = Assistant::$rules;
        
        return $rules;
    }

    public function attributes()
    {
        return [
            'person_id' => 'person_id',
            'meeting_id' => 'meeting_id',
            'confirmation' => 'Confirmación'
        ];
    }
}
