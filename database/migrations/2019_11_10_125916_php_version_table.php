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
            $table->unsignedBigInteger('site_id')
                ->comment('Site ID');
            $table->string('version')
                ->comment('Current PHP version on site');
            $table->string('branch')
                ->comment('Branch PHP version');
            $table->timestamps();
            $table->foreign('site_id')
                ->references('id')
                ->on('sites');
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
