<?php

namespace App\Models\Messages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;
use App\Models\Order\Order;

class UserMessage extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'sender_id',
        'receiver_id',
        'order_id',
        'order_number',
        'title',
        'message',
        'image',
        'is_read',
        'role'
    ];

    
      /**

     * BelongsTo relation with User
     *
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    
    /**

     * BelongsTo relation with User
     *
     * @return BelongsTo
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }


     /* BelongsTo relation with User
     *
     * @return BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }


    /**
     * Get the messageUnread associated with the UserMessage
     *
     * @return \App\Model\Messages\UserMessage
     */
    public function messageUnread(): HasMany
    {
      return  $this->HasMany(UserMessage::class,'order_id','order_id')->where('receiver_id',auth()->user()->id)->where('is_read',false);
    }


}
