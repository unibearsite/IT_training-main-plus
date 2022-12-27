<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;    // 追記
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CurriculumController;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('VoyagerGuard', function () {
            return 'master';
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();  // 追記
        if (request()->isSecure()) {
            \URL::forceScheme('https');
        }
    }
}
