<?php

namespace App\Models\Faq;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Faq extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes,Translatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $translatedAttributes = ['title', 'descriptions'];
    protected $fillable = [
        'id',
        'faq_category_id',
        'title',
        'descriptions',
        'status',
        'role_type'
    ];

  
    /**
     * @return HasOne
     * @description get the detail associated with the post
     */
    public function category(): HasOne
    {
        return $this->hasOne(FaqCategory::class, 'id', 'faq_category_id');
    }
    

}
