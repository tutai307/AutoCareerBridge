<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use App\Events\EmailConfirmationRequired;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailConfirmationNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EmailConfirmationRequired $event): void
    {
        
        // Mail::to($data['email'])->send(new RegisterCheck());
        
    }
}
