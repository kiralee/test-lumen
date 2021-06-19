<?php

namespace App\Providers;

use App\Domains\Order\Providers\OrderProvider;
use App\Domains\Wager\Providers\WagerProvider;
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
        $this->app->register(WagerProvider::class);
        $this->app->register(OrderProvider::class);
    }
}
