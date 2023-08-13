<?php

namespace App\Models\Vehicles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'vehicle_make',
        'vehicle_vin_number',
        'vehicle_model',
        'model_year',
        'is_roof_rack',
        'insurance_photo',
        'registration_photo',
        'registration_expiry_date',
        'insurance_expiry_date',
        'registration_number',
    ];
}
