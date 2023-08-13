<?php

namespace App\Models\Faq;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'descriptions'];
}
