<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id','block_area_name','company_id','device_id','device_notification','gps_location_lat','gps_location_lng','has_water_level_sensor','interval','is_mobile','last_location_gps_lat','last_location_gps_lng','last_sending_data','last_status_battery','name_alias','notification_interval_sent','sensor_spesification','deleted_id','deletedAt','created_id','createdAt','updated_id','updatedAt'
    ];

    public $timestamps = false;
}
