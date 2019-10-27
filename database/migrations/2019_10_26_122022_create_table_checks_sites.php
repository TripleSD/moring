<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableChecksSites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks_sites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('url')->comment('Контролируемый ULR');
            $table->string('php_version')->nullable()->comment('Версия PHP на сайте');
            $table->text('moring_file')->nullable()->comment('Контрльный Moring файл');
            $table->string('moring_version')->nullable()->comment('Версия Moring файла');
            $table->string('moring_timestamp')->nullable()->comment('Время на сервере где расположен сайт');
            $table->integer('http_code')->nullable()->comment('HTTP статус сайта 302/404/');
            $table->string('server_info')->nullable()->comment('Информация о веб сервере');
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
        Schema::dropIfExists('table_checks_sites');
    }
}
