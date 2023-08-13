<?php

namespace App\Models\Devices;

use App\Models\Agencies\AgencyDevice;
use App\Models\Agencies\Agency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'device_name',
        'device_model_id',
        'note',
        'status',
    ];

    // /**
    //  * Get the agencies associated with the Device
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
    //  */
    public function agency()
    {
        return $this->hasOneThrough(Agency::class, AgencyDevice::class, 'device_id', 'id', 'id', 'agency_id');
    }
   
    
}
