<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Stores\Store;
use Carbon\Carbon;
use App\Models\Order\OrderMeta;
use App\Models\Order\OrderProduct;
use App\Constants\OrderDriverStatus;
use App\Models\Order\OrderDelivery;
use App\Models\Order\OrderStatusHistory;
use App\Models\User;
use App\Models\Stores\StoreOwners; 
use App\Models\Stores\StoreAddress;
use App\Models\OrderReviews\OrderReview;
use App\Models\Order\Transaction;
use App\Models\Order\OrderParticipants;


class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'order_number',
        'user_id',
        'store_id',
        'total_items',
        'shipping_method_id',
        'sub_total_amount',
        'discount_amount',
        'delivery_amount',
        'tax_amount',
        'total_amount',
        'order_status',
        'comments',
        'ip_address',
        'latitude',
        'longitude',
        'promo_code',
        'promo_code_id ',
        'is_sharing_order',
        'content',
        'is_scheduled',
        'scheduled_time',
        'reminder_time',
        'reminder_time',
        'dilivery_duration',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $casts = [
        'scheduled_time' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
     ];

    /**
     * BelongsTo relation with store
     *
     * @return BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function storeOwner() {
        return $this->belongsTo(StoreOwners::class, 'store_id', 'store_id');
    }

  /**
     * HasOne relation with OrderDelivery
     *
     * @return HasOne
     */
    public function OrderDriver(): HasOne
    {
        return $this->hasOne(OrderDelivery::class, 'order_id', 'id')->whereIn('delivery_status',[OrderDriverStatus::ACCEPTED,OrderDriverStatus::COMPLETED]);
    }

    /**
     * BelongsTo relation with store
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * HasMany relation with OrderMeta
     *
     * @return HasMany
     */
    public function orderMeta(): HasMany
    {
        return $this->hasMany(OrderMeta::class);
    }

    /**
     * HasMany relation with OrderMeta
     *
     * @return HasMany
     */
    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * HasMany relation with OrderMeta
     *
     * @return HasOne
     */
    public function metadata(): HasOne
    {
        return $this->hasOne(OrderMeta::class);
    }

    /**
     * HasMany relation with Store
     *
     * @return HasOne
     */
    public function storeData(): HasOne
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }

   /**
     * Get Meta data by key
     *
     * @return Array
     */
    public function getMetadata($key)
    {
        if ($this->metadata()->where('order_key', '=', $key)->count()) {
            return $this->getValueAttribute($this->metadata()->where('order_key', '=', $key)->first()->order_values);
        }

        return null;
    }

    /**
     * Get Meta data by key
     *
     * @return Array,
     */
    public function setValueAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['order_values'] = json_encode($value);
            return;
        }

        $this->attributes['order_values'] = $value;
    }

    public function getValueAttribute($value)
    {
        $decodeValue = json_decode($value, true);

        if (is_array($decodeValue)) {
            return $decodeValue;
        }

        return $value;
    }

    /**
     * Get Business Houes
     *
     * @return Array
     */
    public function getShippingAddress()
    {
        $businessHours = $this->getMetadata('shipping_address');

        if (is_array($businessHours)) {
            return $businessHours;
        }

        return [];
    }
    /**
     * HasOne relation with StoreAddress
     *
     * @return HasOne
     */
    public function StoreAddress(): HasOne
    {
        return $this->hasOne(StoreAddress::class,'store_id','store_id');
    }

    /**
     * HasMany relation with OrderMeta
     *
     * @return HasMany
     */
    public function orderUpdateHistory(): HasMany
    {
        return $this->hasMany(OrderStatusHistory::class,'order_id','id');
    }

    public function GetCurrentDurationAttribute()
    {
      $timestamp  = Carbon::create($this->dilivery_duration)->timestamp-Carbon::now()->timestamp;
      if ($timestamp < 0) {
        return 0;
      }
      return gmdate("i",$timestamp);
    }

    // /**
    //  * for getting order view,{customer,driver,store}
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function OrderReview($type)
    // {
    //     return OrderReview::where('order_id',$this->id)->where('rating_for',$type)->where('status',true)->first();
    // }

      /**
     * Get the User Order review
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function OrderReview()
    {
        return $this->hasMany(OrderReview::class, 'order_id', 'id')->where('status',true);
    }

    /**
     * Get all of the TransactionHistory for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function TransactionHistory(): HasMany
    {
        return $this->hasMany(Transaction::class, 'order_id', 'id');
    }


    /**
     * Get the orderParticipant associated with the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function orderParticipant(): HasOne
    {
        return $this->hasOne(orderParticipants::class, 'order_id', 'id');
    }


    public static function boot()
    {   
        parent::boot();
        self::updating(function($model){ 
            $status = Order::where('id', $model->id)->first('order_status');  
            $order_status = $model->order_status;
            if($status->order_status){
                $order_status = $status->order_status;
            }
            OrderStatusHistory::create(
                [
                    'user_id' => auth()->user()->id,
                    'role' => auth()->user()->getRoleNames()->implode(','),
                    'order_id' => $model->id,
                    'old_status' => $order_status,
                    'new_status' => $model->order_status,
                ]
                );
        });
        self::created(function($model){
            OrderStatusHistory::create(                [
                    'user_id' => $model->user_id,
                    'role'    => auth()->user()->getRoleNames()->implode(','),
                    'order_id'  => $model->id,
                    'old_status' => $model->order_status,
                    'new_status' => $model->order_status,
                ]
                );
        });

    }
}
