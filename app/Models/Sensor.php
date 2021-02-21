<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'sensor_company_id','device_id','sensor_master_id','company_id','calibration','calibration_water_level','created_id','updated_id','deleted_id','deletedAt','createdAt','updatedAt'
    ];

    public $timestamps = false;
}
