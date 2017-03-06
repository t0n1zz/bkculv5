<?php

namespace App\Notifications;

use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class notifikasi extends Notification
{
    use Queueable;

    private $url;
    private $message;
    private $message2;
    private $tipe;
    private $user;
    private $cu;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($url,$cu,$message,$message2,$tipe)
    {
        $this->user = Auth::user()->getId();
        $this->url = $url;
        $this->cu = $cu;
        $this->message = $message;
        $this->message2 = $message2;
        $this->tipe = $tipe;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', 'https://laravel.com')
                    ->line('Thank you for using our application!');
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

    public function toDatabase($notifiable)
    {
        return [
            'user' => $this->user,
            'url' => $this->url,
            'cu' => $this->cu,
            'message' => $this->message,
            'message2' => $this->message2,
            'tipe' => $this->tipe
        ];
    }
}
