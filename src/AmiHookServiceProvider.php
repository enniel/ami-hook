<?php

namespace Enniel\AmiHook;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class AmiHookServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap.
     *
     * @return void
     */
    public function boot()
    {
        Config::set('captain_hook.listeners.AMI', 'ami.events.*');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Enniel\Ami\Providers\AmiServiceProvider::class);
        $this->app->register(\Mpociot\CaptainHook\CaptainHookServiceProvider::class);
    }
}
