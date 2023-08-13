<?php

namespace App\Models\Agencies;

use App\Models\User;
use App\Models\Devices\Device;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'agency_name',
        'city',
        'address',
        'account_status',
        'status',
        'phone_number',
        'country_code',
    ];

    /**
     * Get all of the users for the Agency
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function users()
    {
        return $this->hasManyThrough(User::class, AgencyUser::class,'agency_id','id','id','user_id');
    }

    /**
     * Get the devices associated with the agency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devices()
    {
        return $this->hasManyThrough(Device::class, AgencyDevice::class, 'agency_id', 'id', 'id', 'device_id');
    }
    
    /**
     * Get the device associated with the agency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function device()
    {
        return $this->hasOneThrough(Device::class, AgencyDevice::class, 'agency_id', 'id', 'id', 'device_id');
    }

}
