<?php

namespace App\Http\Requests;

class ClassroomRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'discipline_id' => 'required',
            'start_timestamp' => 'required',
            'end_timestamp' => 'required',
            'vacancie' =>  'required|integer',
            'status' => 'required|in:0,1',
            'student_id' => 'required',
        ];
    }
}
