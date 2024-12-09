<?php

namespace App\Listeners;

use App\Events\CollaborationRequestEvent;
use App\Mail\CollaborationRequestMail;
use App\Services\Collaboration\CollaborationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Fluent;

class SendCollaborationRequestMail implements ShouldQueue
{
    /**
     * Create the event listener.
     */

    /**
     * Create the event listener.
     *
     * @param  CollaborationService  $collaborationService
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     * @param CollaborationRequestEvent $event
     */
    public function handle(CollaborationRequestEvent $event): void
    {
        $collaborationRequest = $event->collaborationRequest;

        if ($collaborationRequest->company && $collaborationRequest->company['user']) {
            $universityEmail = $collaborationRequest->university->email;

            try {
                Mail::to($collaborationRequest->university->email)->send(
                    new CollaborationRequestMail($collaborationRequest)
                );
                Log::info("Email sent successfully to {$universityEmail}");
            } catch (\Exception $e) {
                Log::error("Failed to send email to {$universityEmail}: Line:" . $e->getLine() . " - " . $e->getMessage());
            }
        } else {
            Log::error('Invalid collaboration request data', ['collaborationRequest' => $collaborationRequest]);
        }
    }
}
