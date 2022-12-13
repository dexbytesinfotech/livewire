<?php

namespace App\Models\Driver;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Constants\OrderDriverStatus;
use App\Models\Stores\Store;
use App\Models\Order\OrderDelivery;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDriver extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'last_latitude',
        'last_longitude',
        'is_live',
        'last_order_date_time',
        'last_login_date_time',
        'account_status',
        'driver_commission_type',
        'driver_commission_value',
        'is_global_commission'
    ];


    /**
     * @return HasMany
     * @description get the detail associated with the order
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     /**
     * @return HasMany
     * @description get the detail associated with the order
     */
    public function OrderDelivery(): HasMany
    {
        return $this->hasMany(OrderDelivery::class, 'assing_to_id', 'user_id')->whereIn('delivery_status', ['pending','accepted']);
    }

    // finding currenty drivers for send order new order notification
    public static function OrderDeliveryCount($user_id)
    {
        return OrderDelivery::where('assing_to_id',$user_id)->whereIn('delivery_status',[OrderDriverStatus::ACCEPTED,OrderDriverStatus::PENDING])->count();
    }

    // This is the scope we added
    public function scopeFilter($query, $filters,$request)
    {
        return $filters->apply($query,$request);
    }


}
