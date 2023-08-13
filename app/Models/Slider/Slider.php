<?php

namespace App\Models\Slider;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Slider\SliderImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Slider extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes,Translatable;
     /**
     * The transalate attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $translatedAttributes = ['name','description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'code',
        'description',
        'status',
        'is_default',
        'start_date_time',
        'end_date_time'
    ];

    public function sliderImage(): HasMany
    {
        return $this->hasMany(SliderImage::class);
    }

    protected static function boot()
    {

        parent::boot();
        static::creating(function ($slider) {
            $slider->code = $slider->createSlug($slider->name);
        });
    }

    public function createSlug($name)
    {
        if (static::whereCode($slug = Str::slug($name))->exists()) {
            $max = static::whereTranslation('name',$name)->latest('id')->skip(1)->value('code');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }

    public function getSliderImagesForHome($current_time)
    {
        $singleSlider = $this->where('status', 1)->where('is_default', 0)->get();
        $sliderIds = [];
        if (count($singleSlider)) {
            $time = Carbon::createFromTimestampMs($current_time);
            foreach ($singleSlider as $slider) {
                $startTime = Carbon::create($slider->start_date_time);
                $endTime = Carbon::create($slider->end_date_time);

                if ($time->between($startTime, $endTime, true)) {
                    array_push($sliderIds, $slider->id);
                }
            }
        } else {
            $singleSlider = $this->where('is_default', 1)->first();
            array_push($sliderIds, $singleSlider->id);
        }

        if (!empty($sliderIds)) {
            $images = SliderImage::getSliderImages($sliderIds);
            return $images;
        }

        return [];
        $c = new Collection;
    }
}
