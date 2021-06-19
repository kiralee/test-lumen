<?php
namespace App\Domains\Wager\Repositories;

use App\Domains\Wager\Models\WagerModel as WagerModel;
use App\Domains\Wager\Repositories\Contracts\WagerRepositoryContract;

class WagerRepository implements  WagerRepositoryContract
{
    /** @var WagerModel  */
    protected $model;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(WagerModel $model)
    {
        // @codeCoverageIgnoreStart
        $this->model = $model;
        // @codeCoverageIgnoreEnd
    }

    /**
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Builder|WagerModel
     */
    public function create(array $params):WagerModel
    {
        return $this->model->newQuery()->create($params);
    }

    public function update(array $params, int $wagerId)
    {
        return $this->model->newQuery()->find($wagerId)->update($params);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getList(int $page, int $limit):\Illuminate\Database\Eloquent\Collection
    {
        $offSet = ($page - 1) * $limit;
        return $this->model->newQuery()->offset($offSet)->limit($limit)->get();
    }
}
