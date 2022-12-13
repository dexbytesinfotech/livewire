<?php

namespace App\Models\Carts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory ;

    protected $fillable = [
        'id',
        'user_id',
        'store_id',
        'product_id',
        'cart_id',
        'sku',
        'product_name',
        'price',
        'discount_price',
        'quantity',
        'status',
        'content',
        'total_addon_amount',
        'addon_list',
        'image',
        'owner_info',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

     /**
     * @return BelongsTo
     * @description Get the post that owns the details
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(cart::class);
    }
}
