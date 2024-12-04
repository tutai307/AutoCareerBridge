<?php

namespace App\Listeners;

use App\Mail\PasswordReset;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Events\PasswordResetRequested;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAccountRecoveryInstructions implements ShouldQueue
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
    public function handle(PasswordResetRequested $event): void
    {
        $user = $event->user;
        $mail = new PasswordReset($user);

        Cache::put('token_change_password_' . $user->id, $user->remember_token, now()->addMinutes(10));

        try {
            Mail::to($user->email)->send($mail);
        } catch (\Exception $e) {
            Log::error("Failed to send email to {$user->email}: Line:" . $e->getLine() . " - " . $e->getMessage());
        }
    }
}
