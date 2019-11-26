<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesHttpCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites_http_codes', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedBigInteger('site_id')
                ->comment('Site ID');
            $table->string('http_code')
                ->comment('Returned HTTP code');
            $table->timestamps();
            $table->foreign('site_id')
                ->references('id')->on('sites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites_http_codes');
    }
}
