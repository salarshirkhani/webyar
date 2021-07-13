<?php
namespace App\Channels;

use App\Channels\Messages\TextMessage;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    protected function getText($notifiable, Notification $notification): TextMessage {
        if (method_exists($notification, 'toText')) {
            return $notification->toText($notifiable);
        }

        throw new \RuntimeException('Notification is missing toText method.');
    }

    public function send($notifiable, Notification $notification)
    {
        $to = $notifiable->routeNotificationFor('sms');
        if (empty($to))
            return;

        \Smsirlaravel::send([$this->getText($notifiable, $notification)->text], [$to]);
    }
}
