<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Member;
// use Hash;

class MemberAuthCode implements Rule
{
    private $user_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        // 現在のパスワードを取得
        $current_auth_code = Member::find($this->id)->auth_code;

        if(check($value, $current_auth_code)){
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '認証コードが正しくありません';
    }
}
