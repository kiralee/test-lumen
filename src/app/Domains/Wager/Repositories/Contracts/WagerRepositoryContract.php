<?php
namespace App\Domains\Wager\Repositories\Contracts;

use App\Domains\Wager\Models\WagerModel as WagerModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface WagerRepositoryContract
{
    /**
     * @param array $params
     * @return WagerModel|mixed
     */
    public function create(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function update(array $params, int $wagerId);
    /**
     * @return LengthAwarePaginator
     */
    public function getList(int $limit);

    /**
     * @param int $wagerId
     * @return WagerModel|mixed
     */
    public function find(int $wagerId):WagerModel;
}
