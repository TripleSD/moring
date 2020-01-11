<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class B013AddedColumnResolvedInDevicesLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'devices_logs',
            function (Blueprint $table) {
                $table->integer('resolved')
                    ->default(0)
                    ->after('type')
                    ->comment('Resolved status');
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
    }
}
