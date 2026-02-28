<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactFormSubmission extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $form, public $previous)
    {
        //
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
        return (new MailMessage)
                    ->subject('Uusloo kontaktivorm')
                    ->replyTo($this->form['email'])
                    ->bcc('mati@hausers.ee')
                    ->greeting('Tere!')
                    ->line('**Eesnimi:** '. $this->form['firstName'])
                    ->line('**Perenimi:** '. $this->form['lastName'])
                    ->line('**Telefon:** '. $this->form['phone'])
                    ->line('**Email:** '. $this->form['email'])
                    ->line('**Kommentaar:** '. $this->form['comments'])
                    ->line('**URL:** '. $this->previous)
                    ->salutation('Täname!');
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
