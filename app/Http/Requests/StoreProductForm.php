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
            'product_content' =>'required|max:500|string',
            "product_category_id" => "required|exists:product_categories,id|min:1",
            "product_subcategory_id" => "required|min:1|exists:product_subcategories,id",
            "image_1" => "max:10240|nullable|mimes:jpeg,png,jpg,gif|image",
            "image_2" => "max:10240|nullable|mimes:jpeg,png,jpg,gif|image",
            "image_3" => "max:10240|nullable|mimes:jpeg,png,jpg,gif|image",
            "image_4" => "max:10240|nullable|mimes:jpeg,png,jpg,gif|image",
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
            // 'image_1.max' => '10MBを超えるファイルはアップロードできません。',
            // 'image_1.mimes' => '指定のファイル形式以外は添付できません。',
        ];
    }
}
