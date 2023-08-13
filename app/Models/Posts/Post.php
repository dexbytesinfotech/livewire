<?php

namespace App\Models\Posts;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Post extends Model implements TranslatableContract
{
    use HasFactory,SoftDeletes, Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $translatedAttributes = ['title', 'content'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'slug',
        'content',
        'status',
        'post_type',
   ];  

    protected static function boot(){
        parent::boot();

        static::creating(function ($page) {
            $page->slug = $page->createSlug($page->title);          
        });
        
    }

    public function createSlug($title){
        if (static::whereSlug($slug = Str::slug($title))->exists()) {
            $max = static::whereTitle($title)->latest('id')->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }
      
    public function user(){
        return $this->belongsTo(User::class);
    }
}
