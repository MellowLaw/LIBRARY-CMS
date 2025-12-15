<?php

namespace App\Providers;

use App\Models\News;
use App\Models\Page;
use App\Policies\NewsPolicy;
use App\Policies\PagePolicy;
use App\Observers\PageObserver;
use Illuminate\Support\Facades\Gate;
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
        Gate::policy(Page::class, PagePolicy::class);
        Gate::policy(News::class, NewsPolicy::class);

        // Register model observers for audit logging
        Page::observe(PageObserver::class);

        \Illuminate\Support\Facades\RateLimiter::for('login', function (\Illuminate\Http\Request $request) {
            return \Illuminate\Cache\RateLimiting\Limit::perMinute(5)->by($request->email . $request->ip());
        });

        \Illuminate\Support\Facades\RateLimiter::for('register', function (\Illuminate\Http\Request $request) {
            return \Illuminate\Cache\RateLimiting\Limit::perMinute(5)->by($request->ip());
        });
    }
}
