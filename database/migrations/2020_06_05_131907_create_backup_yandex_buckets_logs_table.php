<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackupYandexBucketsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'backup_yandex_buckets_logs',
            function (Blueprint $table) {
                $table->bigIncrements('id')->comment('Id');
                $table->bigInteger('bucket_id')->comment('Bucket id');
                $table->boolean('status')->comment('Availability status');
                $table->boolean('resolved')->comment('Resolving status');
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
        Schema::dropIfExists('backup_yandex_buckets_logs');
    }
}
