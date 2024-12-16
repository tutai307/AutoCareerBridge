<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class SendMailColab extends Mailable
{
    use Queueable, SerializesModels;

    protected $company;
    protected $university;
    protected $sendTo;
    protected $status;
    protected $link;

    /**
     * Create a new message instance.
     */
    public function __construct($company, $university, $sendTo, $status, $link)
    {
        $this->company = $company;
        $this->university = $university;
        $this->sendTo = $sendTo;
        $this->status = $status;
        $this->link = $link;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        if($this->status == STATUS_PENDING){
            $subject = 'Yêu cầu hợp tác mới!';
        }else if($this->status == STATUS_APPROVED){
            $subject = 'Yêu cầu hợp tác đã được chấp nhận!';
        }else if($this->status == STATUS_REJECTED){
            $subject = 'Yêu cầu hợp tác đã bị từ chối!';
        }
        
        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.collaboration.colab',
            with:[
                'company' => $this->company,
                'university' => $this->university,
                'sendTo' => $this->sendTo,
                'status' => $this->status,
                'link' => $this->link
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
