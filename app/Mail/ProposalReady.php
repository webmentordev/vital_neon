<?php

namespace App\Mail;

use App\Models\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProposalReady extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $name, public Proposal $proposal)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('contact@vitalneon.com', 'VitalNeon'),
            subject: 'Your Custom Neon Sign Proposal - Ready for Review',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.proposal-ready',
        );
    }

    public function attachments(): array
    {
        return [
        Attachment::fromPath(public_path($this->proposal->pdf))
            ->as('vital-neon-proposal.pdf')
            ->withMime('application/pdf'),
        ];
    }
}