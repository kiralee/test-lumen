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
     * @return WagerModel|mixed
     */
    public function create(array $params):WagerModel
    {
        return $this->model->newQuery()->create($params);
    }
    /**
     * @param WagerModel $wagerModel
     * @param float $currentSellingPrice
     * @param $params
     */
    private function calculateWagerForPreUpdate(WagerModel $wagerModel, float $currentSellingPrice, &$params)
    {
        $sellingPrice = $wagerModel->selling_price;
        $amountSold = $wagerModel->amount_sold + $currentSellingPrice;
        $percentageSold = ($amountSold / $sellingPrice) * 100;
        $params['amount_sold'] = $amountSold;
        $params['percentage_sold'] = $percentageSold;
    }
    /**
     * @param array $params
     * @param int $wagerId
     * @return mixed|void
     */
    public function update(array $params, int $wagerId)
    {
        /** @var WagerModel $wager */
        $wager = $this->model->newQuery()->lockForUpdate()->findOrFail($wagerId);
        $this->calculateWagerForPreUpdate($wager, $params['current_selling_price'],$params);
        $wager->update($params);
    }
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList(int $limit): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->model->newQuery()->orderBy("id","desc")->sharedLock()->paginate($limit);
    }
    /**
     * @param int $wagerId
     * @return WagerModel|mixed
     */
    public function find(int $wagerId):WagerModel
    {
        return $this->model->newQuery()->sharedLock()->findOrFail($wagerId);
    }
}
