<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'settings',
            function (Blueprint $table) {
                $table->string('parameter')->comment('Parameter');
                $table->string('value')->nullable()->comment('Parameter value');
                $table->timestamps();
            }
        );

        DB::table('settings')->insert(
            [
                'parameter' => 'identificator',
                'value' => null,
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
