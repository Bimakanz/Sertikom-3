<?php

namespace App\Providers;

use Gate;
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
        Gate::define('izin-admin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('izin-guru-admin', function ($user) {
            return in_array($user->role, ['admin', 'guru']);
        });
    }
}
