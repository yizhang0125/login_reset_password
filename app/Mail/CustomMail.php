<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->subject('Reset Password')
                    ->view('emails.customEmail') // Ensure this view exists
                    ->with([
                        'link' => $this->details['link'],
                        'message' => $this->details['message'],
                    ]);
    }
}
