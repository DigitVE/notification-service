<?php

namespace App\Console\Commands;

use App\Services\NotificationSender\NotificationContext;
use App\Services\NotificationSender\NotificationMail;
use App\Services\NotificationSender\NotificationSms;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Queue;
use Throwable;

class NotificationsPull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull notifications from queue and send';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $notificationTypes = [
            'mail' => NotificationMail::class,
            'sms'  => NotificationSms::class,
        ];

        while (1) {
            $queueConnection = Queue::connection(Config::get('queue.default'));
            $rabbitMQJob = $queueConnection->pop();

            if ($rabbitMQJob != null) {
                $payload = $rabbitMQJob->payload();

                try {
                    $data = $payload['data'];

                    $rabbitMQJob->delete();

                    $notificationClass = $notificationTypes[$payload['type']];

                    $context = new NotificationContext();
                    $context->setSender(new $notificationClass());
                    $context->send($data);
                } catch (Throwable $e) {
                    $rabbitMQJob->release(5);
                }
            }
        }

        return true;
    }
}