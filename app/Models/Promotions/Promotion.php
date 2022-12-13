<?php

namespace App\Models\Promotions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Promotions\PromotionsStores;

class Promotion extends Model
{
    use HasFactory;

    protected $dates = [
        'start_date',
        'end_date',
    ];

    protected $fillable = [
        'id',
        'title',
        'code',
        'start_date',
        'end_date',
        'quantity',
        'total_used',
        'value',
        'type',
        'status',
        'can_use_with_promotion',
        'discount_on',
        'product_quantity',
        'type_option',
        'is_allow_to_store', 
        'target',
        'min_order_price',
        'store_id',
    ];




      /**

     * BelongsTo relation with User
     *
     * @return BelongsTo
     */
    public function promotionStore(): BelongsTo
    {
        return $this->belongsTo(PromotionsStores::class, 'promotion_id');
    }

}
