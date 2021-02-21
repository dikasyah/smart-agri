<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengamatanSensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'sensor_id','sensor_name','sensor_unit','is_water_level','is_rainfall','id','sensor_company_id','device_id','value_raw','value_calibration','value_calibration_water_level','datetime','date','time','year','month','day','hour','minute','created_at','datetime_utc'
    ];

    public $timestamps = false;
}
