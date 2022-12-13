<?php

namespace App\Models\Push;

use App\Models\User;
use App\Models\Push\PushMessage;
use App\Models\Push\PushDevice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PushDeliveredMessage extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'push_delivered_message';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'device_id',
        'device_uid',
        'device_type',
        'user_id',
        'message_id',
        'status',
        'error_msg',
        'is_read',
        'is_displayed',
        'delivered_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pushMessage(): HasOne
    {
        return $this->hasOne(PushMessage::class, 'id', 'message_id');
    }

    public function device(): HasOne
    {
        return $this->hasOne(PushDevice::class, 'id', 'device_id');
    }

}
