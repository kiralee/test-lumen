<?php

use App\Domains\Wager\Controllers\WagerController;

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(
    ["prefix" => "wagers"],
    function () use ($router) {
        $router->post('/', 'WagerController@create');
        $router->post('/buy/{wagerId}', 'WagerController@buy');
        $router->get('/', 'WagerController@getList');
    }
);
