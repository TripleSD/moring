<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SitesChecksList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'sites_checks_list',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('site_id')
                    ->comment('Site ID');
                $table->boolean('http_code')
                    ->default(1);
                $table->boolean('check_https')
                    ->default(0);
                $table->boolean('check_ssl')
                    ->default(0);
                $table->foreign('site_id')
                    ->references('id')
                    ->on('sites');
                $table->softDeletes();
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
        //
    }
}
