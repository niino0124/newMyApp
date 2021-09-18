<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\CustomResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;


    protected $fillable = [
        'name_sei',
        'name_mei',
        'nickname',
        'gender',
        'password',
        'password_confirmation',
        'email',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function products(){
        return $this->hasMany('App\Product');
    }
    public function reviews(){
        return $this->hasMany('App\Review');
    }

    public function sendPasswordResetNotification($token){
        $this->notify(new CustomResetPassword($token));
    }

        /**
     * メールアドレス確定メールを送信
     *
     * @param [type] $token
     *
     */
    public function sendEmailResetNotification($auth_code)
    {
        $this->notify(new ChangeEmail($auth_code));
    }
        /**
     * 新しいメールアドレスあてにメールを送信する
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }

    public function order($select){
    if($select == 'asc'){
        return $this->orderBy('created_at', 'asc')->get();
    } elseif($select == 'desc') {
        return $this->orderBy('created_at', 'desc')->get();
    } else {
        return $this->all();
    }
}

}
