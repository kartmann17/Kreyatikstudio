<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\TimeLog;
use App\Models\Article;
use App\Observers\TimeLogObserver;
use App\Observers\ArticleObserver;

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
        TimeLog::observe(TimeLogObserver::class);
        Article::observe(ArticleObserver::class);
    }
}
