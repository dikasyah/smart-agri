<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Device;
use App\Models\Sensor;
use App\Models\PengamatanSensor;
use App\Models\SensorLebung;

class SensorController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 300);
    }

    public function index()
    {
        echo 
        '<html>
        <head>
        <style>
        .loader{
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("https://i.pinimg.com/originals/e9/29/1e/e9291eaddacd460280a34a151dcc5cc4.gif") 
                        50% 50% no-repeat #0e1e2f;
            background-size: 100px;
        }
        </style>
        </head>
        <body>
        <div class="loader"></div>
        </body>
        </html>';

        $now = date('Y-m-d');
        $lebung = SensorLebung::whereDate('date', '=', $now)->get();
        $device = Device::all();
        $sensor = Sensor::all();
        $pengamatan = PengamatanSensor::all();

        return view('sensor.index',['lebung'=>$lebung,'device'=>$device,'sensor'=>$sensor,'pengamatan'=>$pengamatan]);
    }

    public function lebung(Request $request){
        $yesterday = date('Y-m-d',strtotime("-1 days"));

        SensorLebung::whereDate('date', '>=', $yesterday)->delete();

        $data = json_decode($request->data);

        for($i = 0; $i <= count($data)-1;$i++){
            $lebung = new SensorLebung;
            $lebung->entry_id = $data[$i]->entry_id;
            $lebung->object_id = $data[$i]->object_id;
            $lebung->sensor_id = $data[$i]->sensor_id;
            $lebung->value = $data[$i]->value;
            $lebung->date = $data[$i]->date;
            $lebung->time = $data[$i]->time;
            $lebung->save();
        }

        Session::flash('success', "Data sensor lebung berhasil di update");
    }

    public function sensor_plantation(Request $request)
    {
        Device::truncate();
        Sensor::truncate();
        $data = json_decode($request->data);

        for($i=0;$i<=count($data)-1;$i++){
            for($a=0;$a<=count($data[$i]->sensor_companies)-1;$a++){
                $sensor = new Sensor;
                $sensor->sensor_company_id = $data[$i]->sensor_companies[$a]->sensor_company_id;
                $sensor->device_id = $data[$i]->sensor_companies[$a]->device_id;
                $sensor->sensor_master_id = $data[$i]->sensor_companies[$a]->sensor_master_id;
                $sensor->company_id = $data[$i]->sensor_companies[$a]->company_id;
                $sensor->calibration = $data[$i]->sensor_companies[$a]->calibration;
                $sensor->calibration_water_level = $data[$i]->sensor_companies[$a]->calibration_water_level;
                $sensor->created_id = $data[$i]->sensor_companies[$a]->created_id;
                $sensor->updated_id = $data[$i]->sensor_companies[$a]->updated_id;
                $sensor->deleted_id = $data[$i]->sensor_companies[$a]->deleted_id;
                $sensor->deletedAt = $data[$i]->sensor_companies[$a]->deletedAt;
                $sensor->createdAt = $data[$i]->sensor_companies[$a]->createdAt;
                $sensor->updatedAt = $data[$i]->sensor_companies[$a]->updatedAt;
                $sensor->save();
            }

            $device = new Device;
            $device->area_id = $data[$i]->area_id;
            $device->block_area_name = $data[$i]->block_area_name;
            $device->company_id = $data[$i]->company_id;
            $device->device_id = $data[$i]->device_id;
            $device->device_notification = $data[$i]->device_notification;
            $device->gps_location_lat = $data[$i]->gps_location_lat;
            $device->gps_location_lng = $data[$i]->gps_location_lng;
            $device->has_water_level_sensor = $data[$i]->has_water_level_sensor;
            $device->interval = $data[$i]->interval;
            $device->is_mobile = $data[$i]->is_mobile;
            $device->last_location_gps_lat = $data[$i]->last_location_gps_lat;
            $device->last_location_gps_lng = $data[$i]->last_location_gps_lng;
            $device->last_sending_data = $data[$i]->last_sending_data;
            $device->last_status_battery = $data[$i]->last_status_battery;
            $device->name_alias = $data[$i]->name_alias;
            $device->notification_interval_sent = $data[$i]->notification_interval_sent;
            $device->sensor_spesification = $data[$i]->sensor_spesification;
            $device->deleted_id = $data[$i]->deleted_id;
            $device->deletedAt = $data[$i]->deletedAt;
            $device->created_id = $data[$i]->created_id;
            $device->createdAt = $data[$i]->createdAt;
            $device->updated_id = $data[$i]->updated_id;
            $device->updatedAt = $data[$i]->updatedAt;
            $device->save();
        }

        $sensor = Sensor::all();
        return response()->json($sensor);
    }

    public function sensor_pengamatan(Request $request)
    {
        $today = date('Y-m-d');
        PengamatanSensor::whereDate('created_at', '=', $today)->delete();

        $records = json_decode($request->records);
        $master = json_decode($request->master);

        for($i=0;$i<=count($records)-1;$i++){
            $pengamatan = new PengamatanSensor;
            $pengamatan->sensor_id = $master->sensor_id;
            $pengamatan->sensor_name = $master->sensor_name;
            $pengamatan->sensor_unit = $master->sensor_unit;
            $pengamatan->is_water_level = $master->is_water_level;
            $pengamatan->is_rainfall = $master->is_rainfall;
            $pengamatan->id = $records[$i]->id;
            $pengamatan->sensor_company_id = $records[$i]->sensor_company_id;
            $pengamatan->device_id = $records[$i]->device_id;
            $pengamatan->value_raw = $records[$i]->value_raw;
            $pengamatan->value_calibration = $records[$i]->value_calibration;
            $pengamatan->value_calibration_water_level = $records[$i]->value_calibration_water_level;
            $pengamatan->datetime = $records[$i]->datetime;
            $pengamatan->date = $records[$i]->date;
            $pengamatan->time = $records[$i]->time;
            $pengamatan->year = $records[$i]->year;
            $pengamatan->month = $records[$i]->month;
            $pengamatan->day = $records[$i]->day;
            $pengamatan->hour = $records[$i]->hour;
            $pengamatan->minute = $records[$i]->minute;
            $pengamatan->created_at = $records[$i]->created_at;
            $pengamatan->datetime_utc = $records[$i]->datetime_utc;
            $pengamatan->save();
        }

        return response()->json($master);
    }
}
