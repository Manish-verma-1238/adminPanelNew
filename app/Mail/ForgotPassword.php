<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($datas)
    {   
        $this->data = $datas;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Forgot Password',
        );
    }

    public function build()
    {   $emailData = $this->data;
        return $this->from(env('MAIL_FROM_ADDRESS', 'default@example.com'), 'Jimeet Blogs')->subject("Forgot Passwod Jimeet Blogs")->view('emails.forgotPassword',['emailData' =>$emailData]);
    }
}
