<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service')->comment('Service');
            $table->string('status')->nullable()->comment('Some data');
            $table->text('debug_info')->nullable()->comment('Full error text');
            $table->integer('user_id')->comment('User ID');
            $table->string('route')->comment('Current route');
            $table->string('callable_function')->comment('Callable function');
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
        Schema::dropIfExists('system_logs');
    }
}
