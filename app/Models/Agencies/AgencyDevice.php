<?php

namespace App\Models\Agencies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgencyDevice extends Model
{
    use HasFactory;
    use SoftDeletes;
  
    protected $fillable = [
        'agency_id',
        'device_id',
        'status',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

 
}
