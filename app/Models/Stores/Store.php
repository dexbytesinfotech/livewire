<?php

namespace App\Models\Stores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Stores\StoreAddress;
use App\Models\Stores\StoreMetaData;
use App\Models\Order\Order;
use App\Models\Stores\StoreOwners;
use App\Models\Products\Product;
use App\Models\OrderReviews\OrderReview;
use App\Constants\OrderReviewTypes;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'descriptions',
        'phone',
        'restaurant_type',
        'country_code',
        'email',
        'content',
        'order_preparing_time',
        'number_of_branch',
        'logo_path',
        'background_image_path',
        'status',
        'application_status',
        'is_open',
        'is_searchable',
        'is_features',
        'order_number',
        'commission_type',
        'commission_value',
        'is_global_commission'
    ];

    /**
     * HasOne relation with StoreAddress
     *
     * @return HasOne
     */
    public function storeAddress(): HasOne
    {
        return $this->hasOne(StoreAddress::class);
    }

    /**
     * HasMany relation with StoreMetaData
     *
     * @return HasMany
     */
    public function storeMetaData(): HasMany
    {
        return $this->hasMany(storeMetaData::class);
    }


    /**
     * HasMany relation with Order
     *
     * @return BelongsTo
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * HasOne relation with StoreMetaData
     *
     * @return HasOne
     */
    public function metadata(): HasOne
    {
        return $this->hasOne(storeMetaData::class);
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
     * Get Business Houes
     *
     * @return Array
     */
    public function getBusinessHours($format = 'g:i A')
    {
        $businessHours = $this->getMetadata('business_hours');

        if (is_array($businessHours)) {

            foreach ($businessHours as $key => $value) {
                $businessHours[$key]['closing_time'] = (int) $value['closing_time'];
                $businessHours[$key]['opening_time'] = (int) $value['opening_time'];
                $businessHours[$key]['opening_time_format'] = date($format, $value['opening_time']);
                $businessHours[$key]['closing_time_format'] = date($format, $value['closing_time']);
            }

            return $businessHours;
        }

        return [];
    }

   /**
     * @return Array
     */
    public function timeOptions($start = "06:00", $end = "23:00",  $format = 'H:i')
    {
        $return = array();
        $tNow = $tStart = strtotime($start);
        $tEnd = strtotime($end);

        while ($tNow <= $tEnd) {
            $timestamp = (date("H", $tNow) * 3600) + (date("i", $tNow) * 60);
            $return[$timestamp] = date($format, $tNow);
            $tNow = strtotime('+30 minutes', $tNow);
        }

        return $return;
    }

    /**
     * @return Array
     */
    public function getDefaultDays()
    {
        return [
            "monday",
            "tuesday",
            "wednesday",
            "thursday",
            "friday",
            "saturday",
            "sunday",
        ];
    }

    public function getDefaultBusinessHours($start = "07:00", $end = "23:00")
    {
        $storeOpeningHoursArray = array();
        $startTime = strtotime($start);
        $endTime = strtotime($end);
        $days = $this->getDefaultDays();

        $startTime = (date("H", $startTime) * 3600) + (date("i", $startTime) * 60);
        $endTime = (date("H", $endTime) * 3600) + (date("i", $endTime) * 60);

        foreach ($days as $key => $value) {
            $storeOpeningHoursArray[] = [
                'status'    => 1,
                'days'  => $value,
                'opening_time'  => $startTime,
                'closing_time'  => $endTime,
            ];
        }

        return json_encode($storeOpeningHoursArray);
    }

    /**
     * Get all of the comments for the Store
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    //Filter
    // This is the scope we added
     public function scopeFilter($query, $filters,$request)
     {
         return $filters->apply($query,$request);
     }

     /**
     * Get the User Order review
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function OrderRating()
    {
        return $this->hasOne(OrderReview::class, 'store_id', 'id')->where('rating_for',OrderReviewTypes::STORE);
    }
}
