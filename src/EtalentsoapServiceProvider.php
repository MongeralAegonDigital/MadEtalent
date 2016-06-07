<?php

namespace Madetalent\Etalentsoap;

use Illuminate\Support\ServiceProvider;

class EtalentsoapServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Not really anything to boot.
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Artisaninweb\SoapWrapper\ServiceProvider');

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('SoapWrapper',
            'Artisaninweb\SoapWrapper\Facades\SoapWrapper');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        // Nothing here
    }
}