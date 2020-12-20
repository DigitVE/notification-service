<?php

namespace App\Services\NotificationSender;

use App\Services\Contracts\SmsServiceInterface;

class NotificationSms implements NotificationSenderInterface
{
    /**
     * Отправка смс
     *
     * @param array $payload
     * @return bool
     */
    public function send(array $payload): bool
    {
        $smsService = resolve(SmsServiceInterface::class);

        return $smsService->send($payload['message'], $payload['phones']);
    }
}