<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationStatusNotification extends Notification
{
    use Queueable;

    public $reservation;
    public $status;

    public function __construct($reservation, $status)
    {
        $this->reservation = $reservation;
        $this->status = $status;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
       return (new MailMessage)
            ->subject('Reservation ' . ucfirst($this->status))
            ->greeting('Hello ' . $notifiable->name . ' 👋')

            ->line('Your reservation request has been **' . strtoupper($this->status) . '**.')

            ->line('📍 Facility: ' . $this->reservation->facility->name)
            ->line('📅 Date: ' . $this->reservation->date)
            ->line('⏰ Time: ' . $this->reservation->time)

            ->line('Please prepare accordingly.')

            ->line('If you have questions, feel free to contact the admin.')

            ->salutation('Regards, 
            SLSU Facility Reservation System');
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
