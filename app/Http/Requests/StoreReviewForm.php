<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewForm extends FormRequest
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
            'evaluation' =>'required|in:1,2,3,4,5',
            'comment' =>'required|max:500|string',
            'product_id' =>'required',
            'name' =>'required',
            'image_1' =>'required',
        ];
    }
}
