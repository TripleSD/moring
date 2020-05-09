<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPingTrasholdToSitesChecksList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'sites_checks_list',
            function (Blueprint $table) {
                $table->boolean('ping_treshold_status')->default(1)
                    ->after('check_ssl')->comment('Ping treshold status');
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
        Schema::table(
            'sites_checks_list',
            function (Blueprint $table) {
                //
            }
        );
    }
}
