<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Auth\LdapUserProvider;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // add ldap configuration authentication
        Auth::provider('ldap', function ($app, array $config) {
            return new LdapUserProvider($app['hash'], $config['model']);
        });
    }
}
