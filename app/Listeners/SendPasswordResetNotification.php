<?php

namespace App\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPasswordResetNotification
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
    public function handle(PasswordReset $event): void
    {
        /** @var \App\Models\User $user */
        $user = $event->user;
        \Illuminate\Support\Facades\Mail::to($user->Email)->send(new \App\Mail\PasswordResetSuccessMail($user));
    }
}
