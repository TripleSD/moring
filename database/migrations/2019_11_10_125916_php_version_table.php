<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PhpVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites_php_versions', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedBigInteger('site_id')->comment('ID сайта под наблюдением');
            $table->string('php_version')->comment('Текущая версия php');
            $table->timestamps();
            $table->foreign('site_id')->references('id')->on('sites');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
