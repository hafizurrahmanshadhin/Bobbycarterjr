<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReminderNotification extends Notification {
    use Queueable;

    protected $headline;
    protected $description;

    public function __construct($headline, $description) {
        $this->headline    = $headline;
        $this->description = $description;
    }

    public function via($notifiable) {
        return ['database'];
    }

    public function toArray($notifiable) {
        return [
            'headline'    => $this->headline,
            'description' => $this->description,
        ];
    }

    public function toPushNotification($notifiable) {
        return [
            'title' => $this->headline,
            'body'  => $this->description,
        ];
    }
}
