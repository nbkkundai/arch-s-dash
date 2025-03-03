<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordReseted extends Notification
{
    use Queueable;
    private $random_password;
    private $user;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $random_password)
    {
        //
        $this->new_user = $user;
        $this->random_password = $random_password;
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
                ->line('Your password has been reseted: '.$this->new_user->email.'.')
                ->line('Your random password is: '.$this->random_password)
                ->action('Login', url(env('APP_URL').'/login'));
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
