<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class SendMailUniversityApplyJob extends Mailable
{
    use Queueable, SerializesModels;

    protected $university;
    protected $job;
    protected $company;
    /**
     * Create a new message instance.
     */
    public function __construct($university, $company, $job)
    {
        $this->university = $university;
        $this->job = $job;
        $this->company = $company;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->university->user->email, $this->university->name), // Đặt "From" mặc định
            replyTo: [new Address($this->university->user->email, $this->university->name)], // Email động
            subject: $this->university->name . 'đã ứng tuyển ' . $this->job->name
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.jobs.jobApplyPending',
            with: [
                'university' => $this->university,
                'job' => $this->job,
                'company' => $this->company
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
