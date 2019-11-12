<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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

            'title' => 'required|unique:coupons',
            'code' => 'required|unique:coupons',
            'type' => 'required',
            'discount' => 'required', 
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
            'title.required' => 'Please enter the title.',
            'code.required' => 'Please enter the code.',
            'type.required' => 'Please select the type.',
            'discount.required' => 'Please enter the discount', 
        ];
    }

}
