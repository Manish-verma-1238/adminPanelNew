<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegistration extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($datas)
    {
        $this->data = $datas;
    }

    public function build()
    {   $emailData = [
            'name' => $this->data['name'],
        ];
        return $this->from(env('MAIL_FROM_ADDRESS', 'default@example.com'), 'Jimeet Blogs')->subject("Welcome to Jimeet Blogs")->view('emails.userRegistration',['emailData' =>$emailData]);
    }
}
