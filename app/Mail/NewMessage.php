<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $message;

    public function __construct($_message)
    {
        $this->message = $_message;
    }

    public function envelope()
    {
        return new Envelope(
            replyTo: $this->message->email,
            subject: 'Richiesta di informazioni ricevuta' . $this->message->name,
            
        );
    }

    
    public function content()
    {
        return new Content(
            view: 'emails.new-message',
        );
    }

    
    public function attachments()
    {
        return [];
    }
}
