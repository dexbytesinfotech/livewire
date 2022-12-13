<?php

namespace App\Models\Stores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Stores\Store;

class StoreOwners extends Model
{
    use HasFactory;

    protected $table = 'store_owners';

    protected $fillable = [
        'id',
        'store_id',
        'user_id'
    ];


    /**
     * HasOne relation with User
     *
     * @return HasOne
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * HasOne relation with User
     *
     * @return HasOne
     */
    public function store(){
        return $this->belongsTo(Store::class);
    }

}
