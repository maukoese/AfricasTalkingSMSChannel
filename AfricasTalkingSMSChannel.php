<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class AfricasTalkingSMSChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toText($notifiable);

        // Send notification to the $notifiable instance...
    }
}
