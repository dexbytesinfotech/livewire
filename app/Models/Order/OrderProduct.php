<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Products\ProductImages;
use Storage;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_product_id',
        'order_id',
        'order_participant_id',
        'product_id',
        'product_name',
        'qty',
        'note',
        'amount',
        'discount_amount',
        'total_amount',
        'add_on_items',
        'remove_addon_items',
        'sku',
        'content',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * HasMany relation with OrderMeta
     *
     * @return HasMany
     */
    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImages::class, 'product_id', 'product_id');
    }

    /**
     * HasOne relation with OrderMeta
     *
     * @return HasOne
     */
    public function productImage(): HasOne
    {
        return $this->hasOne(ProductImages::class, 'product_id', 'product_id');
    }

    function getProductImage()
    {
        if (emptry($this->productImage)) {
            return (!empty($this->productImage->media->file_name)) ? Storage::disk(config('app_settings.filesystem_disk.value'))->url($this->productImage->media->file_name) : null;
        }
        return $this->productImage;
    }

    
}
