<?php

namespace App\Models\Product;

use App\Models\Products\Product;
use App\Models\Products\ProductAddons;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Stores\Store;

class AddonOption extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_addon_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'small_descriptions',
        'input_type_code',
        'addon_type',
        'is_required',
        'status',
        'order_number',
        'is_searchable',
        'is_filterble',
        'min_select_numbers',
        'max_select_numbers',
        'store_id'
    ];

    /**
     * HasMany relation with ProductAddons
     *
     * @return HasMany
     */
    public function productAddons(): HasMany
    {
        return $this->hasMany(productAddons::class);
    }

    /**
     * Belongs to relation with Products
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id');
    }

    public function addonoptionValue(): HasMany
    {
        return $this->hasMany(AddonOptionValue::class, 'product_addon_option_id');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
}
