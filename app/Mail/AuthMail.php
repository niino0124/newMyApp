<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($str)
    {
        $this->str = $str;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('niino@selva-i.co.jp','Test')
        ->subject('メールアドレス変更の認証コード')
        ->view('mail.changeEmail')
        ->with(['str' => $this->str]);
    }
}
