<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesPingResponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'sites_ping_responses',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->UnsignedbigInteger('site_id')->comment('Site ID');
                $table->foreign('site_id')->references('id')->on('sites');
                $table->float('first')->default(null)->comment('First response');
                $table->float('second')->default(null)->comment('Second response');
                $table->float('third')->default(null)->comment('Third response');
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
        Schema::dropIfExists('sites_ping_responses');
    }
}
