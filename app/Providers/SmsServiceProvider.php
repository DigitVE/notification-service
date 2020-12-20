<?php

namespace App\Providers;

use App\Services\Contracts\SmsServiceInterface;
use App\Services\SmsServices\SmsRuService;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SmsServiceInterface::class, SmsRuService::class);
    }
}
