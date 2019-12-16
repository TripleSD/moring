<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesWebServers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'sites_web_servers',
            function (Blueprint $table) {
                $table->Increments('id');
                $table->unsignedBigInteger('site_id')
                    ->comment('Site ID');
                $table->string('web_server')->nullable()
                    ->comment('Returned web server type');
                $table->timestamps();
                $table->foreign('site_id')
                    ->references('id')->on('sites');
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
        Schema::dropIfExists('sites_web_servers');
    }
}
