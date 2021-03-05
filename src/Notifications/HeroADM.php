<?php

namespace OMerz\HeroADM\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HeroADM extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $datadata;
    protected $via;

    public function __construct($data = null, $via = "database")
    {
        if ($data == null) {
            $this->datadata = "Welcome in " . env('APP_NAME', 'Laravel');
        } else {
            $this->datadata = $data;
        }
        $this->via = $via;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return explode('|', $this->via);
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
            'data' => $this->datadata
        ];
    }
}
