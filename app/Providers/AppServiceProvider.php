<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();

        Blade::if('admin', function () {
            return request()->user()?->admin;
        });

        Gate::define('create-comment', function (User $user, Post $post) {
            return ($post->status?->id !== 4 && $post->status?->id !== 3 || $user->admin);
        });

        Gate::define('like', function (User $user, $input) {
            return (!$input->user()->is($user));
        });

        Gate::define('give-admin', function (User $user) {
            return ($user->id === 11);
        });
    }
}
