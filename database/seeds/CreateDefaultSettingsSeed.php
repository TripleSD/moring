<?php

use Illuminate\Database\Seeder;

class CreateDefaultSettingsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            [
                'parameter' => 'identificator',
                'value' => null,
            ]
        );

        DB::table('settings')->insert(
            [
                'parameter' => 'telegram_api_key',
                'value' => null,
            ]
        );

        DB::table('settings')->insert(
            [
                'parameter' => 'telegram_group_chat_id',
                'value' => null,
            ]
        );

        DB::table('settings')->insert(
            [
                'parameter' => 'telegram_enable_status',
                'value' => 0,
            ]
        );
    }
}
