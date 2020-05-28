<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBackupFtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'backup_ftp_list',
            function (Blueprint $table) {
                $table->bigIncrements('id')->comment('Id');
                $table->string('filename')->comment('File name');
                $table->string('hostname')->comment('Hostname');
                $table->string('login')->nullable()->comment('FTP login');
                $table->string('password')->nullable()->comment('FTP password');
                $table->string('pre')->nullable()->comment('String before filename');
                $table->string('post')->nullable()->comment('String after filename');
                $table->string('folder')->nullable()->comment('Folder path');
                $table->smallInteger('port')->comment('Connection port');
                $table->smallInteger('interval')->comment('Check interval');
                $table->boolean('enabled')->default(0)->comment('Enable/disable status');
                $table->string('description')->comment('Task description');
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
        //
    }
}
