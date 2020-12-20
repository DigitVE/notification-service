<?php

namespace App\Services\SmsServices;

use App\Services\Contracts\SmsServiceInterface;
use Illuminate\Support\Facades\Http;

/**
 * Class SmsRuService
 * @package App\Services\SmsServices
 */
class SmsRuService implements SmsServiceInterface
{
    /**
     * Метод отправки смс нотификации
     *
     * @param string $message
     * @param string $phones
     * @return bool
     */
    public function send(string $message, string $phones): bool
    {
        $apiKey = config('smsru.api_key');

        $responseJson = Http::get("https://sms.ru/sms/send?api_id={$apiKey}&to={$phones}&msg={$message}&json=1");
        $responseObject = json_decode($responseJson->body());

        return $responseObject->status_code == 200;
    }
}