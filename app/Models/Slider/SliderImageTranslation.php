<?php

namespace App\Models\Slider;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderImageTranslation extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'descriptions',
    ];
}
