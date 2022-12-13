<?php

namespace App\Models\Order;

use App\Models\Stores\Store;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'order_id',
        'user_id',
        'store_id',
        'wallet_id',
        'amount',
        'payment_method_code',
        'transaction_type',
        'payment_mode',
        'status',
        'content',
        'payment_receiver',
        'withdrawal_request',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the user associated with the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    
      /**
     * Get the user associated with the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
 
    public function order(): HasOne
    {
        return $this->hasOne(Order::class,'id','order_id');
    }

    /**
     * Get the user associated with the Store
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function store(): HasOne
    {
        return $this->hasOne(Store::class,'id','store_id');
    }
 
}
