<?php

namespace App\Http\Controllers;

use App\ImapMessage;
use App\Jobs\ForwardEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Webklex\IMAP\Facades\Client;

class AutomationController extends Controller
{
    public function gmailImap()

    {
        $client = Client::account('gmail');
        $client->connect();

        $inbox = $client->getFolder('INBOX');
        $messages = $inbox->query()->unseen()->limit(1)->get();

        foreach ($messages as $message) {
            $param = [
                'subject' => $message->getSubject(),
                'from' => $message->getFrom(),
                'content' => $message->getHTMLBody(true),
                'attachments' => []
            ];
            foreach ($message->getAttachments() as $attachment) {
                $fname = 'email-attachments/' . $attachment->getName();
                $upload = Storage::disk('dropbox')->put($fname, $attachment->getContent());
                if ($upload) {
                    $param['attachments'][] = $fname;
                }
            }

            $imapMessage = ImapMessage::create($param);

            if ($imapMessage) dispatch(new ForwardEmail($imapMessage));

            return 'Message queued';
        }

        return 'No message found';

    }
}
