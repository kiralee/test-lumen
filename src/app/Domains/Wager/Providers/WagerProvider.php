<?php

namespace App\Domains\Wager\Providers;
use App\Domains\Wager\Repositories\Contracts\WagerRepositoryContract;
use App\Domains\Wager\Repositories\WagerRepository;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application;

class WagerProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     */
    public function register()
    {
        $this->getApplication()->router->group([
            'namespace' => 'App\Domains\Wager\Controllers',
        ], function ($router) {
            require __DIR__ . '/../routes/api.php';
        });

        $this->getApplication()->bind(WagerRepositoryContract::class,WagerRepository::class);
    }

    /**
     * @return Application|mixed
     */
    public function getApplication()
    {
        return $this->app;
    }
}
