<?php

namespace App\Models\Push;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class PushMessage extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'target_devices',
        'title',
        'text',
        'with_image',
        'custom_image',
        'action_value',
        'latitude',
        'longitude',
        'radius',
        'app_name',
        'send_to',
        'send_at',
        'send_until',
        'delivered_at',
        'is_silent',
        'status',
        'should_visible',
        'error_text',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function PushDeliveredMessage(): BelongsTo
    {
        return $this->belongsTo(PushDeliveredMessage::class,'id','message_id');
    }

}
