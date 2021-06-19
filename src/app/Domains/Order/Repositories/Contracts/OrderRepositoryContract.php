<?php
namespace App\Domains\Order\Repositories\Contracts;

interface OrderRepositoryContract
{
    public function create(array $params);
}
