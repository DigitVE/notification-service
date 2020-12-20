<?php

namespace App\Services\Contracts;

interface SmsServiceInterface
{
    function send(string $message, string $phones);
}