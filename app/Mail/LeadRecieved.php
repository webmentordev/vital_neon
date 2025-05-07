<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class LeadRecieved extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Lead $lead)
    {
        
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('contact@vitalneon.com', 'VitalNeon'),
            subject: 'Mockup Request Recieved',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.lead-recieved',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
