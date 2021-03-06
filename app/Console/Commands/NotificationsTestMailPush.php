<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Queue;

class NotificationsTestMailPush extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:test-mail-push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push test mail notification to queue';

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
        $queueConnection = Queue::connection(Config::get('queue.default'));
        $queueConnection->pushRaw(json_encode([
            'type' => 'mail',
            'data' => [
                'content' => 'Test mail',
                'to'      => 'etercalm93@gmail.com',
                'subject' => 'Test E-Mail',
            ],
        ]));

        return true;
    }
}