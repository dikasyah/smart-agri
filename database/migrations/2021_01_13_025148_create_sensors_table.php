<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->string('sensor_company_id');
            $table->string('device_id');
            $table->string('sensor_master_id');
            $table->string('company_id');
            $table->string('calibration');
            $table->string('calibration_water_level');
            $table->string('created_id');
            $table->string('updated_id');
            $table->string('deleted_id');
            $table->string('deletedAt');
            $table->string('createdAt');
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
        Schema::dropIfExists('sensors');
    }
}
