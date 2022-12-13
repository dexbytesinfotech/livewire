<?php

namespace App\Models\OrderReviews;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;
use App\Models\Order\Order;
use App\Models\Stores\Store;


class OrderReview extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'order_id',
        'store_id',
        'sender_id',
        'receiver_id',
        'rating_for',
        'rating',
        'status',
        'remark',
    ];


    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

     /**
     * BelongsTo relation with User
     *
     * @return BelongsTo
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * BelongsTo relation with User
     *
     * @return BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

 

}
