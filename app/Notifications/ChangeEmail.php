<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;



class ChangeEmail extends Notification
{
    use Queueable; 
    public $auth_code; 

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($auth_code)
    { 
        $this->auth_code = $auth_code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('メールアドレス変更の認証コード') // 件名
                    ->view('mail.changeEmail') // メールテンプレートの指定
                    ->action(
                        'メールアドレス変更',
                        url('reset', $this->auth_code) //アクセスするURL
                    );

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
