<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompleteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name_sei)
    {
        $this->name_sei = $name_sei;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('niino@selva-i.co.jp','Test')
        ->subject('ありがとうございます！会員登録が完了いたしました。')
        ->view('register.email')
        ->with(['name_sei' => $this->name_sei]);
    }
}
