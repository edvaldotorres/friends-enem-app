<?php

namespace App\Http\Requests;

// use Illuminate\Validation\Rule;

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
        switch ($this->route()->getName()) {
            case 'teachers.edit':
            case 'teachers.update':

                // $email = ['required', Rule::unique('users')->ignore(2)];
                // $email = Rule::unique('users')->ignore(2);

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
            'teacher_admin' => 'required|in:0,1',
            'teacher' => 'required|in:1',
            'name' => 'required|min:3|max:255',
            'nickname' => 'required',
            'document' => $document,
            'genre' => 'required|in:1,2,3,4,5',
            'birth_date' => 'required|min:10|date_format:d/m/Y',
            'zipcode' => 'min:9',
            'telephone' => 'required|min:15',
            'whatsapp' => 'required|in:0,1',
            'graduation' => 'required|in:1,2,3,4,5,6,7,8,9',
            'discipline_id' => 'required',
            'email' => $email,
            'password' => $password,
        ];
    }
}
