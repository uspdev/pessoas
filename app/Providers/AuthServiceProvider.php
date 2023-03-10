<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();

        Gate::define('pessoas', function ($user) {
            return $user->hasPermissionTo('pessoas', 'app');
        });

        Gate::define('graduacao', function ($user) {
            return $user->hasPermissionTo('graduacao', 'app');
        });
    
        Gate::define('posgraduacao', function ($user) {
            return $user->hasPermissionTo('posgraduacao', 'app');
        });
    }
    }
}
