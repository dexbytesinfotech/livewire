<?php

namespace App\Models\Push;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Push\PushDeliveredMessage;

class PushDevice extends Model
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
        'device_type',
        'app_version',
        'app_name',
        'device_uid',
        'last_known_latitude',
        'last_known_longitude',
        'device_token_id',
        'device_name',
        'device_model',
        'device_version',
        'push_badge',
        'push_alert',
        'push_sound',
        'status',
        'error_count',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function device(): BelongsTo
    {
        return $this->belongsTo(PushDeliveredMessage::class);
    }
}
