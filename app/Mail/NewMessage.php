<?php

namespace App\Mail;

use App\Models\Message;
use App\Models\Apartment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $apartment;

    public function __construct(Message $message, Apartment $apartment)
    {
        $this->message = $message;
        $this->apartment = $apartment;
    }

    public function build()
    {
        return $this->from('tua-email@example.com')
                    ->subject('Nuovo Messaggio')
                    ->view('emails.new-message')
                    ->with([
                        'message' => $this->message,
                        'apartment' => $this->apartment,
                        // Altri dati necessari per la vista email
                    ]);
    }

    public function envelope()
    {
        return new Envelope(
            replyTo: $this->message->email,
            subject: 'Richiesta di informazioni ricevuta' . $this->message->name . ' ' . $this->message->last_name,
            
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
