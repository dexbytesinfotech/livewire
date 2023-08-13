<?php

namespace App\Models\Worlds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Worlds\Country;
use App\Models\Worlds\State;

class Cities extends Model
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
        'state_id',
        'order',
        'is_default',
        'status',
    ];
    
    /**
     * HasBelongs relation with Order
     *
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

     /**
     * HasBelongs relation with Order
     *
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class,'state_id','id');
    }

    
}
