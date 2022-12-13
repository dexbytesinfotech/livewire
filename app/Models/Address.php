<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_address';
    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'line_1_number_building',
        'line_2_number_street',
        'line_3_area_locality',
        'city',
        'zip_postcode',
        'state',
        'country',
        'first_name',
        'last_name',
        'phone',
        'addrees_type',
        'latitude',
        'longitude',
        'address',
        'additional_information',
        'floor_number',
        'apartment_number',
        'is_primary'
    ];

}
