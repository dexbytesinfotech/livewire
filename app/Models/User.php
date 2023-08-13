<?php

namespace App\Models;

use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Tickets\Ticket;
use App\Models\Users\UserMetaData;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Stores\StoreOwners;
use App\Models\Push\PushDevice;
use Carbon\Carbon;
use App\Models\Push\PushMessage;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use  HasFactory, Notifiable, HasRoles;
    use SoftDeletes;

    protected $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'default_lang',
        'last_login',
        'verification_code',
        'country_code',
        'remember_token',
        'user_name',
        'profile_photo',
        'is_demo',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_demo' => 'boolean',
    ];

    /**
     * Always encrypt password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    
   /**
     * HasOne relation with Ticket
     *
     * @return BelongsTo
     */
    public function tickets()
    {
        return $this->hasOne(Ticket::class, 'assigned_to_user_id', 'id');
    }

   /**
     * HasOne relation with Ticket
     *
     * @return BelongsTo
     */
    public function ticketUser()
    {
        return $this->hasOne(Ticket::class, 'user_id', 'id');
    }

    /**
     * hasMany relation with Post
     *
     * @return BelongsTo
     */
    public function posts(){
        return $this->hasMany(Post::class,'user_id','id');
    }
    /**
     * HasMany relation with StoreMetaData
     *
     * @return HasMany
     */
    public function userMetaData(): HasMany
    {
        return $this->hasMany(UserMetaData::class);
    }

    /**
     * HasMany relation with StoreMetaData
     *
     * @return HasOne
     */
    public function metadata(): HasOne
    {
        return $this->hasOne(UserMetaData::class,);
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
     * hasMany relation with Post
     *
     * @return BelongsTo
     */
    public function device(){
        return $this->hasMany(PushDevice::class, 'user_id', 'id');
    }

    /**
     * HasOne relation with store owner
     *
     * @return BelongsTo
     */
    public function store()
    {
        return $this->hasOne(StoreOwners::class, 'user_id', 'id');
    }


    /**
     *  total_notification
     *
     * @return @array
     */
    public function total_notification($type)
    {
        $query = PushMessage::where('should_visible',true);
        $query->whereHas('PushDeliveredMessage', function ($query) use($type)  {
            $query->where('is_displayed', 'no')->where('user_id',$this->id)->where('status', 'deliver');
            $query->whereHas('device', function ($query) use($type) {
                return $query->where('app_name', '=', $type);
            });
        });
        return $query->count();
    }
}
