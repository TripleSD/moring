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
        Schema::create(
            'devices',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title')->comment('Title to view');
                $table->string('hostname')->comment('Hostname');
                $table->unsignedBigInteger('vendor_id');
                $table->foreign('vendor_id')->references('id')->on('devices_vendors');
                $table->unsignedBigInteger('model_id');
                $table->foreign('model_id')->references('id')->on('devices_models');
                $table->unsignedBigInteger('firmware_id');
                $table->foreign('firmware_id')->references('id')->on('devices_firmwares');
                $table->string('uptime')->nullable()->comment('Device uptime info');
                $table->string('contact')->nullable()->comment('Device contact info');
                $table->string('location')->nullable()->comment('Device location info');
                $table->string('human_model')->nullable()->comment('Device location info. Only to Mikrotik');
                $table->integer('license_level')->nullable()->comment('License level. Only to Mikrotik');
                $table->string('serial_number')->nullable()->comment('Serial number');
                $table->string('packets_version')->nullable()->comment('Packets version. Only to Mikrotik');
                $table->integer('enabled')->default(1)->comment('Enabled/Disable monitoring status');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('network_devices');
    }
}
