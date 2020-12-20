<?php

namespace App\Services\NotificationSender;

use Illuminate\Support\Facades\Mail;

class NotificationMail implements NotificationSenderInterface
{
    /**
     * Отправка почты
     *
     * @param array $payload
     * @return bool
     */
    public function send(array $payload): bool
    {
        Mail::raw($payload['content'], function ($message) use ($payload) {
            $message->to($payload['to'])
                ->subject($payload['subject']);
        });

        return true;
    }
}