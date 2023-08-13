<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'device_id',
        'date',
        'total_ride',
        'total_time',
    ];
}
