<?php
namespace App\Domains\Order\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderModel
 * @package App\Domains\Order\Models
 * @property int $id
 * @property int $wager_id
 * @property double buying_price
 * @property Carbon $bought_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class OrderModel extends Model
{
    protected $table = "orders";

    protected $fillable = [
        'wager_id',
        'buying_price',
        'bought_at'
    ];

    protected $casts = [
        'buying_price' => 'double'
    ];

    protected $dates = [
        'bought_at',
        'created_at',
        'updated_at'
    ];

}
