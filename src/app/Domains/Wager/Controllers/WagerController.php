<?php
namespace App\Domains\Wager\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Domains\Order\Models\OrderModel;
use App\Domains\Order\Repositories\Contracts\OrderRepositoryContract;
use App\Domains\Support\Facades\HttpResponseCode;
use App\Domains\Wager\Repositories\Contracts\WagerRepositoryContract;
use App\Domains\Wager\Rules\LessOrEqualCurrentSellingPriceRule;
use Illuminate\Support\Facades\DB;

class WagerController extends Controller
{
    /** @var int MAX_INTEGER */
    const MAX_INTEGER = 4294967295;

    /** @var int DEFAULT_LIMIT_RECORD  */
    const DEFAULT_LIMIT_RECORD =  10;

    /** @var WagerRepositoryContract  */
    protected $wagerRepositoryContract;

    /** @var OrderRepositoryContract */
    protected $orderRepositoryContract;

    public function __construct(WagerRepositoryContract $wagerRepositoryContract, OrderRepositoryContract $orderRepositoryContract)
    {
        $this->wagerRepositoryContract = $wagerRepositoryContract;
        $this->orderRepositoryContract = $orderRepositoryContract;
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'total_wager_value' => "required|integer|gt:0",
            'odds' => 'required|integer|gt:0|max:'.self::MAX_INTEGER,
            'selling_percentage' => 'required|integer|between:1,100',
            'selling_price' => 'required|gt:0|between:0,999999.99|gt:total_wager_value'
        ]);
        try {
            $postParams = $request->all();
            $params = array_merge($postParams, [
                    "current_selling_price" => $postParams['selling_price'],
                    "percentage_sold" => null,
                    "amount_sold" => null,
                    "placed_at" => Carbon::now()
            ]);
            $wager = $this->wagerRepositoryContract->create($params);
            return $this->setResponse(HttpResponseCode::CODE_201,$wager->toArray());
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            return $this->setResponse(HttpResponseCode::CODE_500,[],$e);
        }
        // @codeCoverageIgnoreEnd
    }

    public function buy(Request $request,int $wagerId)
    {
        $this->validate($request, [
            'buying_price' => ['required','gt:0','between:0,999999.99', new LessOrEqualCurrentSellingPriceRule($this->wagerRepositoryContract, $wagerId)],
        ]);
        try {
            $postParams = $request->all();
            $params = array_merge($postParams, [
                "wager_id" => $wagerId,
                "bought_at" => Carbon::now()
            ]);
            /** @var OrderModel $order */
            DB::beginTransaction();
            $order = $this->orderRepositoryContract->create($params);
            //Handle update wager

            $paramsForUpdateWager = [
                "current_selling_price" => $order->buying_price, //Current selling price should be buying_price
            ];
            $this->wagerRepositoryContract->update($paramsForUpdateWager,$wagerId);
            DB::commit();
            return $this->setResponse(HttpResponseCode::CODE_201,$order->toArray());
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->setResponse(HttpResponseCode::CODE_500,[],$e);
        }

    }

    public function getList(Request $request)
    {
        $limit = $request->input("limit") ?? self::DEFAULT_LIMIT_RECORD;
        $data = $this->wagerRepositoryContract->getList($limit);
        return $this->setResponse(HttpResponseCode::CODE_200,$data->toArray());
    }
}
