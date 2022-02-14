<?php

namespace Shaprk\Sms;

use Illuminate\Support\ServiceProvider;
use IPPanel\Client as IPPanelClient;
use Shaprk\Sms\Exceptions\InvalidConfiguration;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap package services.
     *
     * @return void
     * @throws InvalidConfiguration
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-sms.php' => config_path('laravel-sms.php'),
        ]);

        $this->app->when(SmsChannel::class)
            ->needs(SmsClient::class)
            ->give(function () {
                $config = config('laravel-sms');

                if (is_null($config)) {
                    throw InvalidConfiguration::configurationNotSet();
                }

                return new SmsClient(new IPPanelClient($config['key']), $config);
            });
    }

    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-sms.php', 'laravel-sms');
    }
}
