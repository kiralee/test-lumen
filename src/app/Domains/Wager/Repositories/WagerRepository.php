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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList(int $limit): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->model->newQuery()->paginate($limit);
    }
}
