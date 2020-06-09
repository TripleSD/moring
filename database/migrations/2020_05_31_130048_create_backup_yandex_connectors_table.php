<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackupYandexConnectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backup_yandex_connectors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description')->comment('Description');
            $table->string('token')->comment('Token');
            $table->boolean('status')->comment('Connection status');
            $table->bigInteger('total_space')->comment('Total space');
            $table->bigInteger('used_space')->comment('Used space');
            $table->bigInteger('trash_size')->comment('Trash_size');
            $table->integer('http_code')->comment('Response HTTP code');
            $table->text('comment')->nullable()->comment('User comment');
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
        Schema::dropIfExists('backup_yandex_connections');
    }
}
