<?php

namespace App\Services\NotificationSender;

/**
 * Interface NotificationSenderInterface
 * @package App\Services
 */
interface NotificationSenderInterface
{
    /**
     * Метод отправки нотфикации
     *
     * @param array $payload
     * @return bool
     */
    public function send(array $payload): bool;
}