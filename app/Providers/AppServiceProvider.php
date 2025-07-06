<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Subject;
use App\Models\Infor;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        View::composer('*', function ($view) { //áp dụng cho tất cả các view
            $view->with('subs', Subject::all())->with('informations', Infor::first());
        });
    }
}
