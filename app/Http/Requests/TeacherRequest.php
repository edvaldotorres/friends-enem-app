<?php

namespace App\Http\Requests;

class TeacherRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'teacher_admin' => 'required|in:0,1',
            'teacher' => 'required|in:1',
            'name' => 'required',
            'nickname' => 'required',
            'document' => 'required|min:14|unique:users,document,$this->id,id',
            'genre' => 'required|in:1,2,3,4,5',
            'birth_date' => 'required|min:10|date_format:d/m/Y',
            'zipcode' => 'min:9',
            'telephone' => 'required|min:15',
            'whatsapp' => 'required|in:0,1',
            'graduation' => 'required|in:1,2,3,4,5,6,7,8,9',
            'discipline_id' => 'required',
            'email' => 'required|email|unique:users,email,$this->id,id',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
