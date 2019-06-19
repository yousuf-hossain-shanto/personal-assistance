<?php

namespace App\Mail;

use App\ImapMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForwardMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected $imapMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ImapMessage $imapMessage)
    {
        $this->imapMessage = $imapMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('email.forward', ['data' => $this->imapMessage])->subject($this->imapMessage->subject);

        foreach ($this->imapMessage->attachments as $attachment) {
            $email->attachFromStorageDisk('dropbox', $attachment);
        }

        return $email;
    }
}
