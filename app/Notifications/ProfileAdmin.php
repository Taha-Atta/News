<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProfileAdmin extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $otp;
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // $otp = (new Otp)->generate($notifiable->email, 'numeric',  4, 10);
        return (new MailMessage)
            // ->line('this code to reset your password')
            // ->line('code is :' . $otp->token);
            ->subject('Your OTP for Profile Update')
            ->line('Your One-Time Password (OTP) is: ' . $this->otp)
            ->line('This OTP is valid for 10 minutes.')
            ->line('If you did not request this, please ignore this email.');
            // ->action('Back to check code', url('admin/profile/showverfiycode'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
