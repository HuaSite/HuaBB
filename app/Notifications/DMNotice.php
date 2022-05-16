<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class DMNotice extends Notification
{
    public $myusername;
    public $dm_body;

    public function via()
    {
        return [WebPushChannel::class];
    }

    public function __construct($myusername, $dm_body)
    {
        $this->myusername = $myusername;
        $this->dm_body = $dm_body;
    }

    public function toWebPush()
    {
        return (new WebPushMessage)
            ->title($this->myusername . "さんからのDM")
            ->body($this->dm_body);
    }
}
