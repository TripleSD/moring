<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToBridgePhpVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'bridge_php_versions',
            function (Blueprint $table) {
                $table->integer('deprecated_status')->default(0)->after('branch')
                    ->comment('Deprecated version or not');
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
            'bridge_php_versions',
            function (Blueprint $table) {
                //
            }
        );
    }
}
