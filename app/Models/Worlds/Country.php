<?php

namespace App\Models\Worlds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Worlds\State;
use App\Models\Worlds\Cities;

class Country extends Model
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
        'country_ios_code',
        'nationality',
        'order',
        'is_default',
        'status',
        'country_code'
    ];
    
    /**
     * HasMany relation with Order
     *
     * @return hasMany
     */
    public function state(): HasMany
    {
        return $this->hasMany(State::class);
    }

    
    /**
     * HasOne relation with Order
     *
     * @return hasOne
     */
    public function city(): HasOne
    {
        return $this->hasOne(Cities::class);
    }
}
