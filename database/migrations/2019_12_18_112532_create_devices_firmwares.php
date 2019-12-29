<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesFirmwares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices_firmwares', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Firmware id');
            $table->string('title')->comment('Description for view');
            $table->string('version')->nullable()->comment('Version for view');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices_firmwares');
    }
}
