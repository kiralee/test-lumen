<?php
namespace App\Domains\Order\Repositories;

use App\Domains\Order\Jobs\UpdateDataWager;
use App\Domains\Order\Models\OrderModel;
use App\Domains\Order\Repositories\Contracts\OrderRepositoryContract;

class OrderRepository implements OrderRepositoryContract
{

    protected $model;

    public function __construct(OrderModel $model)
    {
        $this->model = $model;
    }


    public function create(array $params)
    {
        return $this->model->newQuery()->create($params);
    }
}
