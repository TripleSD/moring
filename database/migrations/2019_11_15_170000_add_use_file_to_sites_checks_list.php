<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUseFileToSitesChecksList extends Migration
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
                $table->boolean('use_file')
                    ->after('http_code')
                    ->default(0);
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
