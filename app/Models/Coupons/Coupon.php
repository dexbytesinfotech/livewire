<?php

namespace App\Models\Coupons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'promo_code',
        'discount_type',
        'is_unlimited_coupon',
        'number_of_coupon',
        'coupon_type_option',
        'target',
        'discount_value',
        'min_order_price',
        'products',
        'variants',
        'customers',
        'unlimited_time',
        'start_at',
        'end_at',
        'status',

    ];
}
