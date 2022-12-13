<?php

namespace App\Models\Stores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreMetaData extends Model
{
    use HasFactory;

    protected $table = 'store_metadata';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'store_id',
        'key',
        'value'
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
