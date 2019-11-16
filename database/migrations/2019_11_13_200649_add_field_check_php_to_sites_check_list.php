<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCheckPhpToSitesCheckList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sites_checks_list', function (Blueprint $table) {
            $table->smallInteger('check_php')->default(1)->after('http_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sites_checks_list', function (Blueprint $table) {
            //
        });
    }
}
