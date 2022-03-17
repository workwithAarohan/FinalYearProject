<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('logged-in', function($user){
            return $user;
        });

        // define a admin user role
        Gate::define('isAdmin', function($user) {
            return $user->role == 'Admin';
         });

         //define a author user role
         Gate::define('isAuthor', function($user) {
             return $user->role == 'author';
         });

         // define a editor role
         Gate::define('isEditor', function($user) {
             return $user->role == 'editor';
         });
    }
}
