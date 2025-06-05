<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('delete_blogs', function () {
        $user = auth()->user();

        if ($user == null) {
            return false;
        }

        return $user->is_steward || $user->is_admin;
    });
    }
}
