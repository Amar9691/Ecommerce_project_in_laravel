<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminPasswordResetRequest extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
     
      public $token;
      public $user;
    public function __construct($token,$user)
    {
        $this->token = $token;
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
                    ->line('We Found Request for Your Password Reset If you not made this please ignore and report to our team')
                    ->line(' Reset Password Request  For User id  '.$this->user->email)
                    ->action('Click Here to Reset Password', url('Admin/password/reset/'.$this->user->email.'/'.$this->token))
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
