<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Client;
use App\Models\Property;
use App\Models\Equipment;
use App\Policies\v1\Users;
use App\Policies\v1\Clients;
use App\Policies\v1\Properties;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Client::class => Clients::class,
        Equipment::class => \App\Policies\v1\Equipment::class,
        Property::class => Properties::class,
        User::class => Users::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function(User $user)
        {
            return $user->isAdministrator();
        });

        Gate::define('isManager', function(User $user)
        {
            return $user->isManagingAccount();
        });

        Gate::define('isUser', function(User $user)
        {
            return $user->isUserAccount();
        });
    }
}
