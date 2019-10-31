<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RebuildSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('sites');
        Schema::create('sites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name')->comment('Наименование для отображения в списке');
            $table->text('url')->comment('Контролируемый ULR');
            $table->boolean('https')->nullable()->comment('Наличие поддержки HTTPS');
            $table->text('comment')->nullable()->comment('Описание сайта');
            $table->timestamps();
        });
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
