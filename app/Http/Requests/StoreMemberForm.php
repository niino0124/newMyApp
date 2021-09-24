<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Hankaku;
use Illuminate\Validation\Rule;

class StoreMemberForm extends FormRequest
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
            'name_sei' =>'required|max:20|string',
            'name_mei' =>'required|max:20|string',
            'nickname' =>'required|max:10|string',
            "gender" => "required|integer|in:1,2",
            "password" => ['required','string', new Hankaku, 'min:8','max:20','confirmed'],
            "password_confirmation" => ['required','string', new Hankaku, 'min:8','max:20'],
            "email" => "required|required|unique:members|string|max:200|email",
        ];
    }
}
