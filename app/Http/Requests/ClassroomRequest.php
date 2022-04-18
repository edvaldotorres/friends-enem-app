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
        // dd(empty($this->route('classroom')));

        return [
            'user_id' => 'required',
            'discipline_id' => 'required',
            'start_timestamp' => (empty($this->route('classroom')) ? 'required|date_format:d/m/Y H:i' : 'nullable'),
            'end_timestamp' => (empty($this->route('classroom')) ? 'required|date_format:d/m/Y H:i' : 'nullable'),
            'vacancie' =>  'required|integer',
            'status' => 'required|in:0,1',
            'student_id' => 'required',
        ];
    }
}
