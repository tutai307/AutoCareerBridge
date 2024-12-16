<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class SendMailRejectJobCompany extends Mailable
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
            from: new Address(config('mail.from.address'), config('app.name')), // Đặt "From" mặc định
            subject: 'Tin tuyển dụng của bạn bị từ chối phê duyệt',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.jobs.jobReject',
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
