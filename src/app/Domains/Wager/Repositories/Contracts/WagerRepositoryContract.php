<?php
namespace App\Domains\Wager\Repositories\Contracts;

use App\Domains\Wager\Models\WagerModel as WagerModel;

interface WagerRepositoryContract
{
    /**
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Builder|WagerModel
     */
    public function create(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function update(array $params, int $wagerId);
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getList(int $page, int $limit);

}
