<?php

namespace MadEtalent\EtalentSoap;

use Illuminate\Support\ServiceProvider;

class EtalentSoapServiceProvider extends ServiceProvider
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
        // Nothing here
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