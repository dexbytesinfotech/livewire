<?php

namespace App\Models\Promotions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Promotions\Promotion;

class PromotionsStores extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'promotion_id',
        'store_id',
    ];


    /**
     *  getTotaljoined
     *
     * @return @array
     */
    public function getTotaljoined()
    {
        return $this->hasMany(Promotion::class, 'id')->count();
    }

}
