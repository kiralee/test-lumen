<?php
namespace App\Domains\Wager\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WagerModel
 * @package App\Domains\Wager\Models
 * @property int $id
 * @property int $total_wager_value
 * @property int $odds
 * @property int $selling_percentage
 * @property double $selling_price
 * @property double $current_selling_price
 * @property int $percentage_sold
 * @property int $amount_sold
 * @property Carbon $placed_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class WagerModel extends Model
{
    use HasFactory;

    protected $table = "wagers";

    protected $fillable = [
        'total_wager_value',
        'odds',
        'selling_percentage',
        'selling_price',
        'current_selling_price',
        'percentage_sold',
        'amount_sold',
        'placed_at',
    ];

    protected $casts = [
        'selling_price' => 'double',
        'current_selling_price' => 'double',
        'amount_sold' => 'double',
    ];

    protected $dates = [
        'placed_at',
        'created_at',
        'updated_at',
    ];
}
