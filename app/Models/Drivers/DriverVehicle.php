<?php

namespace App\Models\Drivers;;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DriverVehicle extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'status',
    ];
}
