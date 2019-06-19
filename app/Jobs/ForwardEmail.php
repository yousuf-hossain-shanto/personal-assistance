<?php

namespace App\Jobs;

use App\ImapMessage;
use App\Mail\ForwardMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class ForwardEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $imapMessage;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ImapMessage $imapMessage)
    {
        $this->imapMessage = $imapMessage;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $messageData = $this->imapMessage;
        Mail::to(config('imap.send_to'))->send(new ForwardMailable($messageData));
    }
}
