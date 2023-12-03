<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        // $this->registerPolicies();

        // Auth::extend('admin', function ($app, $name, array $config) {
        //     // Return an instance of your custom guard
        //     return new \App\Auth\Guards\AdminGuard(
        //         Auth::createUserProvider($config['provider']),
        //         $app->make('request')
        //     );
        // });
    }
}
