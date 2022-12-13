<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderMeta extends Model
{
    use HasFactory;

    protected $table = 'order_metas';

    protected $fillable = [
        'id',
        'order_id',
        'order_key',
        'order_values',
        'created_at',
        'updated_at',
    ];

    /**
     *  get store meta data by key
     */
    public function getMetaByKey($orderId, $metaKey)
    {
        $meta = OrderMeta::where('order_id', $orderId)
            ->where('order_key', $metaKey)
            ->first();
        if ($meta) {
            return $meta->value;
        }

        return '';
    }



    /**
     * @return BelongsTo
     * @description Get the post that owns the details
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
