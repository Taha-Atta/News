<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $contact;
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','broadcast'];
    }




    public function toArray(object $notifiable): array
    {
        return [

            'title' => $this->contact->title,
            'name' => $this->contact->name,
            'date' => $this->contact->created_at->diffForHumans(),
            'link' => route('admin.contact.show', $this->contact->id),
        ];
    }

    public function broadcastType(): string
    {
        return 'NewContactNotification';
    }
}
