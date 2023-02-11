<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class registerinfo extends Notification
{
    use Queueable;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('FROM:  Customer Mangenment Team of Amarlinux Group')
                    ->line('Hello! Mr.'.$this->user->name.' Your Account Has been Successfully Created At Our Platform Amarlinux.in')
                    ->line('Your UserName Is '.$this->user->email.' And Password Whatever Your selected')
                    ->action('Vist Our Platform And enjoy our service', route('home'))
                    ->line('Thank you for using our application!')
                    ->line('Regrad')
                    ->line('Mr. Amar Kumar')
                    ->line('CEO & Founder: Amarlinux.it.pvt.ltd');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
