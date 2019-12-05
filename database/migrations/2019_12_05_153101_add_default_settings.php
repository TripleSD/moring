<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert(
            array(
                'parameter' => 'telegram_api_key',
                'value' => null,
            )
        );

        DB::table('settings')->insert(
            array(
                'parameter' => 'telegram_group_chat_id',
                'value' => null,
            )
        );

        DB::table('settings')->insert(
            array(
                'parameter' => 'telegram_enable_status',
                'value' => 0,
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
        //
    }
}
