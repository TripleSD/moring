<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPingsSitesTrasholds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'sites',
            function (Blueprint $table) {
                $table->integer('ping_treshold')->default('0')
                    ->after('pending')->comment('Ping treshold (int) value');
            }
        );

        Schema::table(
            'sites',
            function (Blueprint $table) {
                $table->boolean('ping_treshold_status')->default('0')
                    ->after('ping_treshold')->comment('Ping treshold status');
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