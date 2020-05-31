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
            $table->text('comment')->nullable()->comment('Comment');
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
