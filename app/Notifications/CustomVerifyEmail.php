<?php

namespace App\Notifications;

use App\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends VerifyEmail
{
    use Queueable;

    protected $user;

    public function __construct(User $user)

    {

        $this->user = $user;

    }

    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        return (new MailMessage)
            ->view('your custom view', ['link' => $this->verificationUrl($notifiable), 'user' => $this->user]);
    }

}
