<?php

namespace App\Listeners;

use App\Mail\RegisterCheck;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\EmailConfirmationRequired;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailConfirmationNotification implements ShouldQueue
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
        $user = $event->user;
        $mail = new RegisterCheck($user);
        Cache::put('email_verification_' . $user->id, $user->remember_token, now()->addMinutes(10));
        try {
            Mail::to($user->email)->send($mail);
        } catch (\Exception $e) {
            Log::error("Failed to send email to {$user->email}: Line:" . $e->getLine() . " - " . $e->getMessage());
        }
    }
}
