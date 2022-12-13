<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         //'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Passport::routes();

        // Passport::tokensCan([
        //     'customer' => 'Customer Type',
        //     'provider' => 'Provider Type',
        //     'driver' => 'Driver Type',
        //     'admin' => 'Admin User Type',
        // ]);

       // Passport::tokensExpireIn(now()->addMinutes(config('auth.token_expiration.token')));
       // Passport::refreshTokensExpireIn(now()->addMinutes(config('auth.token_expiration.refresh_token')));
        //
    }
}
