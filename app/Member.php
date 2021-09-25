<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\CustomResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;//追記


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class Member extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use Sortable;//追記

    protected $fillable = [
        'name_sei',
        'name_mei',
        'nickname',
        'gender',
        'password',
        'password_confirmation',
        'email',
    ];


	public $sortable = ['id','created_at'];//追記(ソートに使うカラムを指定

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
