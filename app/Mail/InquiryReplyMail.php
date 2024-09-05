<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InquiryReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry;
    public $reply;

    public function __construct($inquiry, $reply)
    {
        $this->inquiry = $inquiry;
        $this->reply = $reply;
    }

    public function build()
    {
        return $this->subject('Reply to Your Inquiry')
                    ->view('emails.inquiry_reply');
    }
}
