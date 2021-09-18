<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Rules\Hankaku;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'login_id', 'password',
    ];

    protected $hidden = ['password', ];

    protected function rules(){
        return [
            'login_id'     => ['min:7|max:10|string|required|new Hankaku'],
            'password' => ['min:8|max:20|string|required|new Hankaku'],
        ];
}
}
