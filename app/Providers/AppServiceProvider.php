<?php

namespace App\Providers;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Illuminate\Support\ServiceProvider;

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
        //
        //
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        FacadesGate::define('administration',function(User $user){
            return $user->role == Role::ADMIN ? Response::allow() : Response::deny('debes ser administrador.');
        });
        $this->register();
    }
}
