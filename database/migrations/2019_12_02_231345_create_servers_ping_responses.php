<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersPingResponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers_ping_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->UnsignedbigInteger('server_id')->comment('Server ID');
            $table->foreign('server_id')->references('id')->on('servers');
            $table->float('first')->default(null)->comment('First response');
            $table->float('second')->default(null)->comment('Second response');
            $table->float('third')->default(null)->comment('Third response');
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
        Schema::dropIfExists('servers_ping_responses');
    }
}
