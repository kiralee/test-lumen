<?php
namespace App\Domains\Wager\Jobs;

use App\Domains\Order\Models\OrderModel;
use App\Domains\Wager\Repositories\Contracts\WagerRepositoryContract;
use App\Jobs\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateDataWager extends Job implements ShouldQueue
{
    use InteractsWithQueue;

    protected $wagerRepositoryContract;

    protected $orderModel;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(WagerRepositoryContract $wagerRepositoryContract, OrderModel $orderModel)
    {
        $this->wagerRepositoryContract = $wagerRepositoryContract;
        $this->orderModel = $orderModel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Process update
        $params = [
            "current_selling_price" => 9000,
            "percentage_sold" => 9,
            "amount_sold" => 9
        ];
        Log::info("Trigger Event".json_encode($params));
        $this->wagerRepositoryContract->update($params,$this->orderModel->wager_id);
    }
}
