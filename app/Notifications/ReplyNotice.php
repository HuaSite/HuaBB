<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class ReplyNotice extends Notification
{
    public $username;
    public $post_id;

    public function via()
    {
        return [WebPushChannel::class];
    }

    public function __construct($username, $post_id)
    {
        $this->username = $username;
        $this->post_id = $post_id;
    }

    public function toWebPush()
    {
        return (new WebPushMessage)
            ->title($this->username . "さんから投稿:". $this->post_id ."へのリプライ");
    }
}
