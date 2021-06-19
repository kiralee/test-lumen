<?php
namespace Database\Factories\Domains\Wager\Models;

use App\Domains\Wager\Models\WagerModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class WagerModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WagerModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total_wager_value' => $this->faker->randomNumber(3),
            'odds' => $this->faker->randomNumber(3),
            'selling_percentage' => $this->faker->randomNumber(2),
            'selling_price' => $this->faker->randomFloat(2,0,9999.99),
            'current_selling_price' => $this->faker->randomFloat(2,0,9999.99) ,
            'percentage_sold' => $this->faker->randomNumber(2),
            'amount_sold' => $this->faker->randomFloat(2,0,9999.99),
            'placed_at' => Carbon::now(),
        ];
    }
}
