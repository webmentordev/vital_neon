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

class LeadAlert extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Lead $lead)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('contact@vitalneon.com', 'VitalNeon'),
            subject: 'New Lead Alert ⚡',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mails.lead-alert',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}