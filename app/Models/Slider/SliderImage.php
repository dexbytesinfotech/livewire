<?php

namespace App\Models\Slider;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Slider\Slider;
use Carbon\Carbon;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class SliderImage extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes,Translatable;
    /**
     * The transalate attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $translatedAttributes = ['title','descriptions'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slider_id',
        'title',
        'descriptions',
        'action_values',
        'image',
        'order_number',
        'status',
        'start_date_time',
        'end_date_time'
    ];

    public function slider(): BelongsTo
    {
        return $this->belongsTo(Slider::class);
    }

    public function getSliderImages($sliderIds = [])
    {
        if(!empty($sliderIds))
        {
            $images = $this->wherein('id', $sliderIds)->where('status', 1)->get();
            $responseImages = [];
            foreach($images as $image)
            {
                array_push($responseImages, [
                    'id' => $image->id,
                    'name' => (string)$image->title,
                    'image' => $image->image,
                ]);
            }
            return $responseImages;
        }
        return false;
    }




    public function getHomeSlider()
    {
        return $this->where('status', 1)->orderBy('order_number', 'ASC')->whereDate('start_date_time','<=' ,Carbon::now())->whereDate('end_date_time','>=' ,Carbon::now())->whereHas('slider', function($q) {
            $q->where(function ($q)
            {
                $q->where('status', true);
                $q->whereDate('start_date_time','<=' ,Carbon::now());
                $q->whereDate('end_date_time','>=' ,Carbon::now());
            });
        })->get();
    }

}
