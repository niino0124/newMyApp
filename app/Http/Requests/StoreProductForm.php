<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductForm extends FormRequest
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
            'name' =>'required|max:100|string',
            "product_category_id" => "required|integer",
            "product_subcategory_id" => "required|integer",
            "image_1" => "image|mimes:jpeg,png,jpg,gif|max:10240|nullable",
            'product_content' =>'required|max:100|string',
        ];
    }
}
