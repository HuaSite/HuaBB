<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class EveryonePost extends Notification
{
    public $username;
    public $title;

    public function via()
    {
        return [WebPushChannel::class];
    }

    public function __construct($username, $title)
    {
        $this->username = $username;
        $this->title = $title;
    }

    public function toWebPush()
    {
        return (new WebPushMessage)
            ->title($this->username . "さんから全員へ")
            ->body($this->title);
    }
}
