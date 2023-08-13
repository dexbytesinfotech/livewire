<?php

namespace App\Models\Drivers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'email',
        'date_of_birth',
        'driver_license',
        'driver_license_expiry_date',
        'phone_number',
        'city',
        'state',
        'ride_platform',
        'account_status',
        'driver_photo',
        'trial_account',
        'stripe_customer_id',
        'damoov_token',
        'user_id',
    ];
}
