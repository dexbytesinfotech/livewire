<?php

namespace App\Models\Stores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class StoreType extends Model implements TranslatableContract
{
    use HasFactory,Translatable;
     /**
     * The transalate attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $translatedAttributes = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id','name','status'
    ];
}
