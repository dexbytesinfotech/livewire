<?php

namespace App\Models;

use App\Models\Posts\Post;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Tickets\Ticket;
use App\Models\Users\UserMetaData;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Order\Order;
use App\Models\Stores\StoreOwners;
use App\Models\Push\PushDevice;
use App\Models\Driver\UserDriver;
use App\Models\Messages\UserMessage;
use App\Constants\OrderDriverStatus;
use App\Constants\OrderStatus;
use App\Models\Order\OrderDelivery;
use App\Models\Push\PushDeliveredMessage;
use Carbon\Carbon;
use App\Models\Push\PushMessage;
use App\Models\OrderReviews\OrderReview;
use App\Models\Carts\Cart;
use App\Models\Carts\CartsParticipants;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'default_lang',
        'last_login',
        'verification_code',
        'country_code',
        'remember_token',
        'user_name',
        'profile_photo',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

   /**
     * HasOne relation with Ticket
     *
     * @return BelongsTo
     */
    public function tickets()
    {
        return $this->hasOne(Ticket::class, 'assigned_to_user_id', 'id');
    }

     /**
     * HasOne relation with Messages
     *
     * @return BelongsTo
     */
    public function senderMessages()
    {
        return $this->hasOne(UserMessage::class, 'sender_id', 'id');
    }

    /**
     * HasOne relation with Messages
     *
     * @return BelongsTo
     */
    public function receivermessages()
    {
        return $this->hasOne(UserMessage::class, 'receiver_id', 'id');
    }

   /**
     * HasOne relation with Ticket
     *
     * @return BelongsTo
     */
    public function ticketUser()
    {
        return $this->hasOne(Ticket::class, 'user_id', 'id');
    }

    /**
     * hasMany relation with Post
     *
     * @return BelongsTo
     */
    public function posts(){
        return $this->hasMany(Post::class,'user_id','id');
    }
    /**
     * HasMany relation with StoreMetaData
     *
     * @return HasMany
     */
    public function userMetaData(): HasMany
    {
        return $this->hasMany(UserMetaData::class);
    }

    /**
     * HasMany relation with StoreMetaData
     *
     * @return HasOne
     */
    public function metadata(): HasOne
    {
        return $this->hasOne(UserMetaData::class,);
    }

    /**
     * Get Meta data by key
     *
     * @return Array
     */
    public function getMetadata($key)
    {
        if ($this->metadata()->where('key', '=', $key)->count()) {
            return $this->getValueAttribute($this->metadata()->where('key', '=', $key)->first()->value);
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
            $this->attributes['value'] = json_encode($value);
            return;
        }

        $this->attributes['value'] = $value;
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
     * hasMany relation with Post
     *
     * @return BelongsTo
     */
    public function device(){
        return $this->hasMany(PushDevice::class, 'user_id', 'id');
    }

    /**
     * HasOne relation with Order
     *
     * @return BelongsTo
     */
    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

    /**
     * HasOne relation with Order
     *
     * @return BelongsTo
     */
    public function store()
    {
        return $this->hasOne(StoreOwners::class, 'user_id', 'id');
    }

     /**
     * HasOne relation with Order
     *
     * @return BelongsTo
     */
    public function driver()
    {
        return $this->hasOne(UserDriver::class, 'user_id', 'id');
    }
    /**
     * BelongsTo relation with Driver Order
     *
     * @return BelongsTo
     */
    public function OrderDelivery()
    {
        return $this->hasMany(OrderDelivery::class, 'assing_to_id', 'id')->where('delivery_status',OrderDriverStatus::PENDING);
    }

    /**
     *  getTotalMessageAttribute
     *
     * @return @array
     */
    public function getTotalMessageAttribute()
    {
        return $this->hasMany(UserMessage::class,'receiver_id')->where('is_read', 0)->count();
    }

    /**
     *  getTotalNotificationAttribute
     *
     * @return @array
     */
    public function getTotalNotificationAttribute()
    {
        $query = PushMessage::where('should_visible',true);
        $query->whereHas('PushDeliveredMessage', function ($query)  {
            $query->where('is_displayed', 'no')->where('user_id',$this->id);
        });
        return $query->count();
    }

    /**
     * Get the User Order review
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function OrderRating($type)
    {
        return round(OrderReview::where('receiver_id',$this->id)->where('rating_for',$type)->avg('rating'),1);
    }
    /**
     * Get the User Order review count
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function OrderRatingCount($type)
    {
        return OrderReview::where('receiver_id',$this->id)->where('rating_for',$type)->count();
    }

    /**
     *  DriverOrderCount
     *
     * @return @array
     */
    public function DriverOrderCount($type)
    {

        $query = Order::where('order_status',OrderStatus::COMPLETED);
        $query->whereHas('OrderDriver', function ($query) use ($type) {
            $query->where('assing_to_id',$this->id);
                $query->where('delivery_status', OrderDriverStatus::COMPLETED);
        });
        switch ($type) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'week':
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', date('m'));
                break;
            default:
            $query->whereDate('created_at', Carbon::today());
                break;
        }
        return $query->count();
    }
    /**
     * Get the cart associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cart(): HasMany
    {
        return $this->HasMany(Cart::class);
    }

    /**
     * Get all of the JoinCart for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function JoinCart(): HasMany
    {
        return $this->hasMany(CartsParticipants::class)->with('cart');
    }

}
