<?php

namespace App\Models\Stores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreAddress extends Model
{
    use HasFactory;

    protected $table = 'store_address';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'store_address_id',
        'store_id',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'landmark',
        'city',
        'state',
        'country',
        'zip_post_code',
        'is_primary',
        'addrees_type',
        'latitude',
        'longitude'
    ];

    /**
     * @return BelongsTo
     * @description Get the post that owns the details
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }



    
}
