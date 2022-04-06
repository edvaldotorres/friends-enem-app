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
        switch ($this->route()->getName()) {
            case 'students.edit':
            case 'students.update':
                $document = 'required|min:11|max:14';
                $email = 'required|email';
                $password = 'nullable|string|min:8|confirmed';
                break;
            default:
                $document = 'required|min:11|max:14|unique:users,document';
                $email = 'required|email|unique:users,email';
                $password = 'required|string|min:8|confirmed';
                break;
        }
        
        return [
            'teacher' => 'required|in:0',
            'name' => 'required|min:3|max:255',
            'nickname' => 'required',
            'document' => $document,
            'genre' => 'required|in:1,2,3,4,5',
            'birth_date' => 'required|min:10|date_format:d/m/Y',
            'zipcode' => 'min:9',
            'color_declaration' => 'required|in:1,2,3,4,5,6,7',
            'observation' => 'nullable',
            'email' => $email,
            'password' => $password,
        ];
    }
}
