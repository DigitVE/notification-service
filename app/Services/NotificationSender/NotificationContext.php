<?php

namespace App\Services\NotificationSender;

/**
 * Class NotificationContext
 * @package App\Services\NotificationSender
 */
class NotificationContext
{
    private $sender;

    public function setSender(NotificationSenderInterface $sender)
    {
        $this->sender = $sender;
    }

    public function send($data)
    {
        return $this->sender->send($data);
    }
}