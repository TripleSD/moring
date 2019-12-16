<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToSitesPingResponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'sites_ping_responses',
            function (Blueprint $table) {
                $table->addColumn('float', 'average')->default(null)->after('third')->comment(
                    'Average or three previous pings'
                );
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
            'sites_ping_responses',
            function (Blueprint $table) {
                $table->dropColumn('average');
            }
        );
    }
}
