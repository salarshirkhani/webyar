<?php

namespace App\Notifications;

use App\Channels\Messages\TextMessage;
use App\Channels\SmsChannel;
use App\Models\Enquiry;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewEnquiry extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $enquiry;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param Enquiry $enquiry
     */
    public function __construct(User $user, Enquiry $enquiry)
    {
        $this->user = $user;
        $this->enquiry = $enquiry;
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
            ->subject("✅ درخواست خرید جدید در پُل")
            ->greeting("سلام {$this->user->name}!")
            ->line("یک درخواست خرید برای شما با عنوان {$this->enquiry->title} ارسال شده است!")
            ->line("برای مشاهده و پاسخ به این درخواست، بر روی دکمه زیر کلیک کنید.")
            ->action('مشاهده درخواست', route('dashboard.owner.enquiries.show', $this->enquiry));
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
            ->line("یک درخواست خرید برای شما با عنوان {$this->enquiry->title} ارسال شده است!");
    }
}
