<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $user_account, $reset_token, $webinfo)
    {
        $this->user = $user;
        $this->user_account = $user_account;
        $this->reset_token = $reset_token;
        $this->webinfo = $webinfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $reset_token = $this->reset_token;
        $user_account = $this->user_account;
        $webinfo = $this->webinfo;
        return $this->subject('Reset Password ' . date('Y-m-d H:i:s'))
                    ->markdown('frontend.mail.resetpassword')
                    ->with([
                        'user' => $user,
                        'reset_token' => $reset_token,
                        'user_account' => $user_account,
                        'web_info' => $webinfo,
                        'linkReset' => env('APP_BACKOFFICE_URL','') . '/resetpassword/' . $reset_token->token
                    ]);
    }
}
