<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTypeMoringVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'moring_versions',
            function (Blueprint $table) {
                $table->renameColumn('version', 'build');
            }
        );
        Schema::table(
            'moring_versions',
            function (Blueprint $table) {
                $table->string('build')->change();
            }
        );
        Schema::table(
            'moring_versions',
            function (Blueprint $table) {
                $table->dropColumn('human_version');
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
