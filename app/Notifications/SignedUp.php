<?php

namespace App\Notifications;

use App\Channels\Messages\TextMessage;
use App\Channels\SmsChannel;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SignedUp extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $password;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param string|null $password
     */
    public function __construct(User $user, string $password = null)
    {
        $this->user = $user;
        $this->password = $password;
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
        $msg = (new MailMessage)
                    ->subject('❤️❤️به ماهنامه صنایع چاپ و بسته بندی خوش آمدید❤️❤️')
                    ->greeting("سلام {$this->user->name}!")
                    ->line('ثبت‌نام شما در وب‌سایت پُل ماهنامه چاپ و بسته‌بندی را گرامی می‌داریم.')
                    ->line("ایمیل شما: {$this->user->email}");
        if (!empty($this->password))
            $msg->line("رمزعبور شما: $this->password");
        else
            $msg->line("رمزعبور شما: شماره همراه یا تلفن شرکت شما بدون کد شهر");

        return $msg
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
        $msg = (new TextMessage())
                    ->line("به وب‌سایت پُل ماهنامه صنایع چاپ و بسته‌بندی خوش‌آمدید!")
            ->line("ایمیل: {$this->user->email}");;
        if (!empty($this->password))
            $msg->line("رمزعبور: $this->password");
        else
            $msg->line("رمزعبور: شماره همراه یا تلفن شرکت شما بدون کد شهر");
        $msg->line("ورود به سایت:")
            ->line(route('login'));
        return $msg;
    }
}
