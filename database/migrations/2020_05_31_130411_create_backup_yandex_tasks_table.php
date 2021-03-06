<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackupYandexTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'backup_yandex_tasks',
            function (Blueprint $table) {
                $table->bigIncrements('id')->comment('Id');
                $table->unsignedBigInteger('connector_id')->comment('Connector ID');
                $table->string('filename')->comment('File name');
                $table->string('pre')->nullable()->comment('String before filename');
                $table->string('post')->nullable()->comment('String after filename');
                $table->string('folder')->nullable()->comment('Folder path');
                $table->smallInteger('interval')->comment('Check interval');
                $table->boolean('enabled')->comment('Enable/disable status');
                $table->string('description')->comment('Task description');
                $table->text('comment')->nullable()->comment('User comment');
                $table->integer('http_code')->comment('HTTP response code');
                $table->foreign('connector_id')
                    ->references('id')
                    ->on('backup_yandex_connectors');
                $table->timestamps();
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
        Schema::dropIfExists('backup_yandex');
    }
}
