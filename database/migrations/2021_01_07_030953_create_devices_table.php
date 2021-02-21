<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('area_id');
            $table->string('block_area_name');
            $table->string('company_id');
            $table->string('device_id');
            $table->string('device_notification');
            $table->string('gps_location_lat');
            $table->string('gps_location_lng');
            $table->string('has_water_level_sensor');
            $table->string('interval');
            $table->string('is_mobile');
            $table->string('last_location_gps_lat');
            $table->string('last_location_gps_lng');
            $table->string('last_sending_data');
            $table->string('last_status_battery');
            $table->string('name_alias');
            $table->string('notification_interval_sent');
            $table->string('sensor_spesification');
            $table->string('deleted_id');
            $table->string('deletedAt');
            $table->string('created_id');
            $table->string('createdAt');
            $table->string('updated_id');
            $table->string('updatedAt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
