<?php

namespace App\Domains\Order\Providers;
use App\Domains\Order\Repositories\Contracts\OrderRepositoryContract;
use App\Domains\Order\Repositories\OrderRepository;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application;

class OrderProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     */
    public function register()
    {
        $this->getApplication()->bind(OrderRepositoryContract::class,OrderRepository::class);
    }

    /**
     * @return Application|mixed
     */
    public function getApplication()
    {
        return $this->app;
    }
}
