<?php

namespace App\Models\Worlds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Worlds\Country;
use App\Models\Worlds\Cities;

class State extends Model
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
        'country_id',
        'abbreviation',
        'is_default',
        'status',
        'order',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
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
