<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class LikeNotice extends Notification
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
            ->title($this->username . "さんがPost: ". $this->post_id . "の投稿にいいねしました。");
    }
}
