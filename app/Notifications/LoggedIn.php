<?php

namespace App\Notifications;

use App\Channels\Messages\TextMessage;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoggedIn extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->subject('✅ ورود جدید به وب‌سایت پُل ماهنامه چاپ و بسته بندی')
            ->greeting("سلام {$this->user->name}!")
            ->line("شما یک ورود به حساب کاربری خود داشته‌اید.")
            ->action('ورود به حساب', route('login'));
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
            ->line("شما یک ورود به حساب کاربری خود در وب‌سایت پُل داشته‌اید.");
    }
}
