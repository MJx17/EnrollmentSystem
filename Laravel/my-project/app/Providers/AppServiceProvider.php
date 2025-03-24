<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\CheckWildcardPermission;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

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
    public function boot(Router $router): void
    {
        // Gate before logic for admin role
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });

        // Register middleware alias
        $router->aliasMiddleware('wildcard.permission', CheckWildcardPermission::class);

        // Register the Livewire component
        Livewire::component('dual-listbox', \App\Http\Livewire\DualListbox::class);


       

    }

    
   
     
  
    
}
