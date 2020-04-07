<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameSnmpVersionColumnAndSnmpPortColumnAndSnmpCommunityColumn extends Migration
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
                $table->renameColumn('snmp_port', 'port');
            }
        );

        Schema::table(
            'devices',
            function (Blueprint $table) {
                $table->renameColumn('snmp_community', 'community');
            }
        );

        Schema::table(
            'devices',
            function (Blueprint $table) {
                $table->renameColumn('snmp_version', 'version');
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
