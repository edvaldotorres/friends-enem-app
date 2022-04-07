<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class TeacherRequest extends BaseRequest
{
    public function all($keys = null)
    {
        return $this->validateFields(parent::all());
    }

    public function validateFields(array $inputs)
    {
        $inputs['document'] = str_replace(['.', '-'], '', $this->request->all()['document']);

        return $inputs;
    }

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
            'name' => 'required|min:3|max:255',
            'nickname' => 'required',
            'document' => (!empty($this->route('teacher')) ? 'required|min:11|max:14|unique:users,document,' . $this->route('teacher') : 'required|min:11|max:14|unique:users,document'),
            'genre' => 'required|in:1,2,3,4,5',
            'birth_date' => 'required|min:10|date_format:d/m/Y',
            'zipcode' => 'min:9',
            'telephone' => 'required|min:15',
            'whatsapp' => 'required|in:0,1',
            'graduation' => 'required|in:1,2,3,4,5,6,7,8,9',
            'discipline_id' => 'required',
            'email' => (!empty($this->route('teacher')) ? 'required|email|unique:users,email,' . $this->route('teacher') : 'required|email|unique:users,email'),
            'password' => (empty($this->route('teacher')) ? 'required|string|min:8|confirmed' : 'nullable|string|min:8|confirmed'),
        ];
    }
}
