<?php

namespace App\Notifications;

use App\Channels\Messages\TextMessage;
use App\Channels\SmsChannel;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscribedToPlan extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $plan;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param $plan
     */
    public function __construct(User $user, $plan)
    {
        $this->user = $user;
        $this->plan = $plan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("✅ ثبت پکیج {$this->plan->name}")
            ->greeting("سلام {$this->user->name}!")
            ->line("شما با موفقیت پکیج {$this->plan->name} را خریداری کردید!")
            ->action('ورود به حساب کاربری', route('login'));
    }

    /**
     * Get the text representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return TextMessage
     */
    public function toText($notifiable)
    {
        return (new TextMessage())
            ->line("سلام {$this->user->name}!")
            ->line("شما با موفقیت پکیج {$this->plan->name} را خریداری کردید!");
    }
}
