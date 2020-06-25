<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackupYandexBucketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'backup_yandex_buckets',
            function (Blueprint $table) {
                $table->bigIncrements('id')->comment('Id');
                $table->unsignedBigInteger('connector_id')->comment('Connector ID');
                $table->smallInteger('interval')->comment('Check interval');
                $table->boolean('enabled')->comment('Enable/disable status');
                $table->string('description')->comment('Task description');
                $table->text('comment')->nullable()->comment('User comment');
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
        Schema::dropIfExists('backup_yandex_trash');
    }
}
