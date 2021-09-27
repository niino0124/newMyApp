<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryForm extends FormRequest
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
            'name' =>'required|max:20|string',
            'sub_name0' =>'required|max:20|string',
            'sub_name1' =>'nullable|max:20|string',
            'sub_name2' =>'nullable|max:20|string',
            'sub_name3' =>'nullable|max:20|string',
            'sub_name4' =>'nullable|max:20|string',
            'sub_name5' =>'nullable|max:20|string',
            'sub_name6' =>'nullable|max:20|string',
            'sub_name7' =>'nullable|max:20|string',
            'sub_name8' =>'nullable|max:20|string',
            'sub_name9' =>'nullable|max:20|string',
        ];
    }
}
