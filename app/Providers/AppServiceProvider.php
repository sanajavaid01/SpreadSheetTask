<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\DataManagement;
use App\Implementations\GoogleSheetApi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DataManagement::class, GoogleSheetApi::class);
    }
}
