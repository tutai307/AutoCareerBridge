<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewJobPostedMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $company;
    protected $job;
    /**
     * Create a new message instance.
     */
    public function __construct($company, $job)
    {
        $this->company = $company;
        $this->job = $job;
    }


    /**
     * Get the message envelope.
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->company->email, $this->company->company->name), // Đặt "From" mặc định
            replyTo: [new Address($this->company->email, $this->company->company->name)], // Email động
            subject: 'Tin tuyển dụng ' . $this->company->company->name
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.jobs.jobNew',
            with: [
                'company' => $this->company,
                'job' => $this->job
            ]
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
