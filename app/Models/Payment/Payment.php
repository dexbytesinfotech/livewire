<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'driver_id',
        'total_amount',
        'stripe_transaction_id',
        'driving_mileage',
        'start_date',
        'end_date',
        'payment_status',
        'frequency',
    ];
}
