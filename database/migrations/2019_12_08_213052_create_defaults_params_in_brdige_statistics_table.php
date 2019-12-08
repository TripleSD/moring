<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultsParamsInBrdigeStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('bridge_statistics')->insert(
            array(
                'parameter' => 'bridge_moring_versions',
            )
        );

        DB::table('bridge_statistics')->insert(
            array(
                'parameter' => 'bridge_php_versions',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('defaults_params_in_brdige_statistics');
    }
}
