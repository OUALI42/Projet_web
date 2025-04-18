<?php

namespace App\Providers;

use App\Models\Cohort;
use App\Models\Teachers_Cohorts;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);
        //to dynamically display promotions in the sidebar
        View::share('cohorts', Cohort::all());
    }
}
