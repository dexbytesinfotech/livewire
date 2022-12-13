<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class OrderParticipants extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'participent_amount',
        'payment_status',
        'transaction_id',
        'created_at',
        'updated_at',
    ];
    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
