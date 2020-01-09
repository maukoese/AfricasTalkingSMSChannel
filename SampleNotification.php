<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Channels\AfricasTalkingSMSChannel;
use App\Channels\Messages\VoiceMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoicePaid extends Notification
{
    use Queueable;

    /**
     * Get the notification channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return [AfricasTalkingSMSChannel::class];
    }

    /**
     * Get the text representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return VoiceMessage
     */
    public function toText($notifiable)
    {
        // ...
    }
}
