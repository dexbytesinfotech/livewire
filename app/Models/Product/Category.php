<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_categories';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'store_id',
        'parent_id',
        'name',
        'image',
        'status',
        'is_featured',
        'order_number',
        'description'
    ];


    /**
     * @return BelongsTo
     * @description Get the post that owns the details
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return HasOne
     * @description get the detail associated with the category
     */
    public function categoryone(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    /**
     * @return Category
     * @description get the detail associated with the category
     */
    public function categorymany(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getProductCategoryBelongsToStore($store_id)
    {
        return Model::where(function ($query) use ($store_id) {
            $query->where('store_id', '=', null)
                ->orWhere('store_id', '=', $store_id);
        })->where('status',true)->get();
    }
}
