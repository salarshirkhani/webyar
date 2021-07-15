<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \Rinvex\Subscriptions\Models\Plan::class => 'App\Policies\PlanPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('search-database', function (User $user) {
            return $user->type == 'customer';
        });

        Gate::define('search-database', function (User $user) {
            return $user->type == 'employee';
        });
    }
}
