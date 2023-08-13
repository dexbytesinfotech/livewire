<?php

namespace App\Models\Faq;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class FaqCategory extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes,Translatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $translatedAttributes = ['name'];
    protected $fillable = [
        'id',
        'name',
        'status',
    ];


     /**
     * @return BelongsTo
     * @description Get the post that owns the details
     */
    public function faq(): BelongsTo
    {
        return $this->belongsTo(Faq::class);
    }
}

