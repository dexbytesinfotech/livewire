<?php

namespace App\Models\Carts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\User;


class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'store_id',
        'cart_number',
        'status',
        'content',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot(){
        parent::boot();

        static::creating(function ($cart_number) {
            $cart_number->cart_number = rand(10000000,99999999);
        });

    }

    public function createSlug($cart_number){
        do {
            $code = rand(10000000,99999999);
        } while (Cart::whereCartNumber($code)->exists());
    }

    public function cartItem(): HasMany
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    public function cartParticipants(): HasMany
    {
        return $this->hasMany(CartsParticipants::class, 'cart_id');
    }
    /**
     * Get the user that owns the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
