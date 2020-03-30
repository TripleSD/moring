<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortSshColumnAndPortTelnetColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'devices',
            function (Blueprint $table) {
                $table->integer('port_ssh')->nullable()->after('snmp_version');
                $table->integer('port_telnet')->nullable()->after('port_ssh');
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
