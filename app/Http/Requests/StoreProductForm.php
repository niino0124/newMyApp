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
            // "image_1" => "mimes:jpeg,png,jpg,gif|max:10000|nullable",
            // "image_2" => "mimes:jpeg,png,jpg,gif|max:10000|nullable",
            "image_1" => "nullable|max:10000|image",
            "image_2" => "nullable|max:10000|image",
            // "image_3" => "image|mimes:jpeg,png,jpg,gif|max:10240|nullable",
            // "image_4" => "image|mimes:jpeg,png,jpg,gif|max:10240|nullable",
            'product_content' =>'required|max:100|string',
        ];
    }

        /**
     * バリデーションエラーメッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'image_1.max' => '10MBを超えるファイルはアップロードできません。',
            'image_1.mimes' => '指定のファイル形式以外は添付できません。',
        ];
    }
}
