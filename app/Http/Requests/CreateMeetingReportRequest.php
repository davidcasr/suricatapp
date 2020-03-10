<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\MeetingReport;

class CreateMeetingReportRequest extends FormRequest
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
        return MeetingReport::$rules;
    }

    public function attributes()
    {
        return [
            'user_id' => 'user_id',
            'person_id' => 'person_id',
            'meeting_id' => 'meeting_id',
            'description' => 'Descripción'
        ];
    }
}
