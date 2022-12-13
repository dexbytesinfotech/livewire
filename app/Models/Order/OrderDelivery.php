<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Stores\Store;
use App\Models\Order\OrderMeta;
use App\Models\Order\OrderProduct;
use App\Models\User;

class OrderDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'delivery_status',
        'deliver_by',
        'assing_to_id',
        'assing_date',
        'content',
        'created_at'
    ];
    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assing_to_id', 'id');
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

}
