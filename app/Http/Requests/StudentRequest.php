<?php

namespace App\Http\Requests;

class StudentRequest extends BaseRequest
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
            'type' => 'required|in:3',
            'name' => 'required|min:3|max:255',
            'nickname' => 'required',
            'document' => (!empty($this->route('student')) ? 'required|min:11|max:14|unique:users,document,' . $this->route('student') : 'required|min:11|max:14|unique:users,document'),
            'genre' => 'required|in:1,2,3,4,5',
            'birth_date' => 'required|min:10|date_format:d/m/Y',
            'zipcode' => 'min:9',
            'color_declaration' => 'nullable|in:1,2,3,4,5,6,7',
            'observation' => 'nullable',
            'email' => (!empty($this->route('student')) ? 'required|email|unique:users,email,' . $this->route('student') : 'required|email|unique:users,email'),
            'password' => (empty($this->route('student')) ? 'required|string|min:8|confirmed' : 'nullable|string|min:8|confirmed'),
        ];
    }
}
