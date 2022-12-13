<?php

namespace App\Models\Products;

use App\Models\Product\AddonOption;
use App\Models\Product\AddonOptionValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use App\Models\Products\ProductInventory;
use App\Models\Products\ProductAddons;
use App\Models\Products\ProductCategories;
use App\Models\Stores\Store;
use App\Models\Stores\StoreAddress;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'parent_product_id',
        'store_id',
        'name',
        'descriptions',
        'sku',
        'price',
        'price_sale',
        'sale_start_date',
        'sale_end_date',
        'discount_id',
        'inventory_id',
        'tax_id',
        'categories_ids',
        'is_featured',
        'maximum_qty_per_order',
        'mimimum_qty_per_order',
        'status',
    ];
    /**
     * BelongsTo relation with ProductInventory
     *
     * @return BelongsTo
     */
    public function productInventory(): BelongsTo
    {
        return $this->belongsTo(productInventory::class, 'inventory_id', 'id');
    }
    /**
     * HasMany relation with ProductAddOn
     *
     * @return HasMany
     */
    public function productAddons(): HasMany
    {
        return $this->hasMany(ProductAddons::class)->with('productAddonOption');
    }



    /**
     * Get all of the comments for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function productAddAddons(): HasManyThrough
    {
        return $this->hasManyThrough(AddonOption::class,ProductAddons::class,'product_id','id','id','product_addon_option_id')->where('product_addon_options.addon_type','add');
    }


    /**
     * Get all of the comments for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function productRemoveAddons(): HasManyThrough
    {
        return $this->hasManyThrough(AddonOption::class,ProductAddons::class,'product_id','id','id','product_addon_option_id')->where('product_addon_options.addon_type','remove');
    }



    /**
     * BelongsTo relation with ProductCategories
     *
     * @return BelongsTo
     */
    public function productCategories(): BelongsTo
    {
        return $this->belongsTo(ProductCategories::class, 'categories_ids', 'id');
    }
    /**
     * HasMany relation with ProductAddonOption
     *
     * @return HasMany
     */
    public function productAddonOption()
    {
        return $this->hasMany(AddonOption::class);
    }

     /**
     * HasMany relation with getProductByStore
     *
     * @return HasMany
     */
    public function getProductByStore($store_id)
    {
        return Model::where(function ($query) use ($store_id) {
            $query->where('store_id', '=', 0)
                ->orWhere('store_id', '=', $store_id)->where('status',1);
        })->orderBy('id', 'ASC')->get();
    }

    
     /**
     * HasOne relation with Store
     *
     * @return HasOne
     */
    public function Productstore(): HasOne
    {
        return $this->hasOne(Store::class,'id','store_id');
    }

       /**
     * HasOne relation with StoreAddress
     *
     * @return HasOne
     */
    public function ProductstoreAddress(): HasOne
    {
        return $this->hasOne(StoreAddress::class,'store_id','store_id');
    }

    /**
     * Get the image associated with the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image(): HasOne
    {
        return $this->hasOne(ProductImages::class)->orderBy('created_at','DESC');
    }

}
