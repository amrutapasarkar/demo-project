<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CmsRequest extends FormRequest
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
        return [
            'name' => 'required',
            'title' => 'required',
            'summary-ckeditor' => 'required',
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
            'template_name.required' => 'Please enter the name.',
            'template_key.required' => 'Please enter the title.',
            'summary-ckeditor.required' => 'Please enter the content.', 
        ];
    }
}
