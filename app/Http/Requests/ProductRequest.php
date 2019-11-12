<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required',
            'product_img' => 'required',
            'product_price' => 'required',
            'color' => 'required',
            'quantity' => 'required',
            'category' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'product_name.required' => 'Please enter the product name.',
            'product_img.required' => 'Please select the product image.',
            'product_price.required' => 'Please enter the product price.',
            'color.required' => 'Please enter the product color.',
            'quantity.required' => 'Please enter the product quantity.',
            'category.required' => 'Please select the product category.',

        ];
    }
}
