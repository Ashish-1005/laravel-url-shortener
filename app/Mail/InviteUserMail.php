<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $link;

    /**
     * Create a new message instance.
     */
    public function __construct($link)
    {
        $this->link = $link;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Join our platform')
                    ->view('emails.invite')
                    ->with([
                        'link' => $this->link,
                    ]);
    }
}
