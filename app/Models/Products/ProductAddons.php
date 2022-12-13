<?php

namespace App\Models\Products;

use App\Models\Product\AddonOption;
use App\Models\Product\AddonOptionValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Stores\Store;

class ProductAddons extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'product_id',
        'product_addon_option_id',
    ];

    /**
     * BelongsTo relation with Produtcs
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(product::class, 'id', 'product_id');
    }


    /**
     * BelongsTo relation with ProductAddonOption
     *
     * @return BelongsTo
     */
    public function productAddonOption(): BelongsTo
    {
        return $this->belongsTo(AddonOption::class, 'product_addon_option_id', 'id');
    }


    /**
     * BelongsTo relation with productAddonOptionValues
     *
     * @return BelongsTo
     */
    public function productAddonOptionValues(): HasMany
    {
        return $this->hasMany(AddonOptionValue::class, 'product_addon_option_id', 'product_addon_option_id');
    }

     /**
     * BelongsTo relation with Store
     *
     * @return BelongsTo
     */
   public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
}
