<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class NewJobPostedMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $company;
    /**
     * Create a new message instance.
     */
    public function __construct($company)
    {
        $this->company = $company;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    public function envelope()
    {
        // return new Envelope(
        //     from: new Address($this->company->email, 'AutoCareerBridge'), // Đặt "From" mặc định
        //     replyTo: [new Address($this->company->email, $this->company->name)], // Email động
        //     subject: 'New Job Posted'
        // );

    return new Envelope(
        from: new Address($this->company->email, $this->company->name), // "From" động
        subject: 'New Job Posted'
    );

    }

    /**

     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.jobs.jobNew',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
