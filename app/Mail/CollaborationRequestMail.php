<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CollaborationRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $collaborationRequest;

    public function __construct($collaborationRequest)
    {
        $this->collaborationRequest = $collaborationRequest;
    }

    public function envelope(): Envelope
    {
        // Kiểm tra nếu company và user hợp lệ
        if ($this->collaborationRequest->company && $this->collaborationRequest->company->user) {
            $fromEmail = $this->collaborationRequest->company->user->email;
            $companyName = $this->collaborationRequest->company->name;

            // Kiểm tra xem email có hợp lệ không
            if (!filter_var($fromEmail, FILTER_VALIDATE_EMAIL)) {
                Log::error('Invalid email address: ' . $fromEmail);
                throw new \Exception('Invalid email address');
            }
           Log::info('fromEmail', [$fromEmail]);
           Log::info('fromName', [$companyName]);
            // Trường hợp email hợp lệ, không cần dấu ngoặc kép cho companyName
            return new Envelope(
                from: new Address($fromEmail, $companyName), // Đặt tên công ty vào mà không cần dấu ngoặc kép
                replyTo:[
                    new Address($fromEmail, $companyName)
                ], // Đặt tên công ty vào mà không cần dấu ngoặc kép
                subject: $this->collaborationRequest->title,
            );
        } else {
            // Nếu không có company hoặc user hợp lệ
            Log::error('Company or User is missing', ['collaborationRequest' => $this->collaborationRequest]);
            throw new \Exception('Company or User is missing');
        }
    }


    public function content(): Content
    {
        Log::info('content', [$this->collaborationRequest->content]);
        return new Content(
            view: 'mail.collaboration.collaboration_request',
            with: [
                'content' => $this->collaborationRequest->content,
                'collaborationRequest' => $this->collaborationRequest,
                'subject' => $this->collaborationRequest->title,
            ],
        );
    }
    public function attachments(): array
    {
        return [];
    }
}

