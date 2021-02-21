<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengamatanSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengamatan_sensors', function (Blueprint $table) {
            $table->string('sensor_id')->nullable();
            $table->string('sensor_name')->nullable();
            $table->string('sensor_unit')->nullable();
            $table->string('is_water_level')->nullable();
            $table->string('is_rainfall')->nullable();
            $table->string('id')->nullable();
            $table->string('sensor_company_id')->nullable();
            $table->string('device_id')->nullable();
            $table->string('value_raw')->nullable();
            $table->string('value_calibration')->nullable();
            $table->string('value_calibration_water_level')->nullable();
            $table->string('datetime')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->string('day')->nullable();
            $table->string('hour')->nullable();
            $table->string('minute')->nullable();
            $table->string('created_at')->nullable();
            $table->string('datetime_utc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengamatan_sensors');
    }
}
