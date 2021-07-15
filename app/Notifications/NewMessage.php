<?php

namespace App\Notifications;

use App\Channels\Messages\TextMessage;
use App\Channels\SmsChannel;
use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessage extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param Message $message
     */
    public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->message = $message;
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
            ->subject("✅ پاسخ جدید در پُل")
            ->greeting("سلام {$this->user->name}!")
            ->line("از طرف {$this->message->from->name} به شما پیامی ارسال شده است.")
            ->line("محتویات:")
            ->line($this->message->text)
            ->action('مشاهده درخواست', route("dashboard.{$this->user->type}.conversations.show", $this->message->conversation_id));
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
            ->line("از طرف {$this->message->from->name} به شما پیامی ارسال شده است.");
    }
}
