<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableServers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('addr')
                ->comment('Server IP');
            $table->integer('enabled')
                ->default('1')
                ->comment('Enable/Disable status');
            $table->string('token')
                ->comment('Token for auth');
            $table->string('description')
                ->nullable()
                ->comment('Server\'s description');
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
        Schema::dropIfExists('servers');
    }
}
