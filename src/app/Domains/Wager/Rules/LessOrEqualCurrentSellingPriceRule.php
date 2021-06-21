<?php
namespace App\Domains\Wager\Rules;

use \Illuminate\Contracts\Validation\Rule;
use \App\Domains\Wager\Repositories\Contracts\WagerRepositoryContract;
class LessOrEqualCurrentSellingPriceRule implements Rule
{
    protected $wagerRepositoryContract;

    protected $wagerId;

    public function __construct(WagerRepositoryContract $wagerRepositoryContract, int $wagerId)
    {
        $this->wagerRepositoryContract = $wagerRepositoryContract;
        $this->wagerId = $wagerId;
    }

    public function passes($attribute, $value)
    {
        //Validate current buying_price must be less or equal with current_selling_price
        try{
            $wager = $this->wagerRepositoryContract->find($this->wagerId);
            return $value <= $wager->current_selling_price;
        }catch (\Exception $e){
            return false;
        }
    }


    public function message()
    {
        return trans("The :attribute must be less or equal with current_selling_price or wager not found");
    }
}
