<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequestUpdate extends FormRequest
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
       // dd($this->route());
         return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->users,
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'Please enter the your first name.',
            'last_name.required' => 'Please enter your last name.',
            'email.required' => 'Please enter email.',
            'password.required' => 'Please enter the password', 
            'confirm_password.required' => 'Please enter the confirm password.', 

        ];
    }
}
